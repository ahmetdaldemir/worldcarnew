// wrap in UMD - see https://github.com/umdjs/umd/blob/master/jqueryPlugin.js
(function(factory) {
	if (typeof define === "function" && define.amd) {
		define([ "jquery" ], function($) {
			factory($, window, document);
		});
	} else {
		factory(jQuery, window, document);
	}
})(function($, window, document, undefined) {
	"use strict";
	var pluginName = "countrySelect", id = 1, // give each instance its own ID for namespaced event handling
	defaults = {
		// Default country
		defaultCountry: "tr",
		// Position the selected flag inside or outside of the input
		defaultStyling: "inside",
        // don't display these countries
        excludeCountries: [],
		// Display only these countries
		onlyCountries: [],
		// The countries at the top of the list. Defaults to United States and United Kingdom
		preferredCountries: [ "tr","de", "fr", "nl", "be", "ch", "at", "dk", "se", "no", "fi", "gb", "us" ],
	}, keys = {
		UP: 38,
		DOWN: 40,
		ENTER: 13,
		ESC: 27,
		PLUS: 43,
		A: 65,
		Z: 90
	}, windowLoaded = false;
	// keep track of if the window.load event has fired as impossible to check after the fact
	$(window).on('load', function() {
		windowLoaded = true;
	});
	function Plugin(element, options) {
		this.element = element;
		this.options = $.extend({}, defaults, options);
		this._defaults = defaults;
		// event namespace
		this.ns = "." + pluginName + id++;
		this._name = pluginName;
		this.init();
	}
	Plugin.prototype = {
		init: function() {
			// Process all the data: onlyCountries, excludeCountries, preferredCountries, defaultCountry etc
			this._processCountryData();
			// Generate the markup
			this._generateMarkup();
			// Set the initial state of the input value and the selected flag
			this._setInitialState();
			// Start all of the event listeners: input keyup, selectedFlag click
			this._initListeners();
			// Return this when the auto country is resolved.
			this.autoCountryDeferred = new $.Deferred();
			// Get auto country.
			this._initAutoCountry();

			return this.autoCountryDeferred;
		},
		/********************
		 *  PRIVATE METHODS
		 ********************/
		// prepare all of the country data, including onlyCountries, excludeCountries, preferredCountries and
		// defaultCountry options
		_processCountryData: function() {
			// set the instances country data objects
			this._setInstanceCountryData();
			// set the preferredCountries property
			this._setPreferredCountries();
		},
		// process onlyCountries array if present
		_setInstanceCountryData: function() {
			var that = this;
			if (this.options.onlyCountries.length) {
				var newCountries = [];
				$.each(this.options.onlyCountries, function(i, countryCode) {
					var countryData = that._getCountryData(countryCode, true);
					if (countryData) {
						newCountries.push(countryData);
					}
				});
				this.countries = newCountries;
			} else if (this.options.excludeCountries.length) {
                var lowerCaseExcludeCountries = this.options.excludeCountries.map(function(country) {
                    return country.toLowerCase();
                });
                this.countries = allCountries.filter(function(country) {
                    return lowerCaseExcludeCountries.indexOf(country.iso2) === -1;
                });
            } else {
				this.countries = allCountries;
			}
		},
		// Process preferred countries - iterate through the preferences,
		// fetching the country data for each one
		_setPreferredCountries: function() {
			var that = this;
			this.preferredCountries = [];
			$.each(this.options.preferredCountries, function(i, countryCode) {
				var countryData = that._getCountryData(countryCode, false);
				if (countryData) {
					that.preferredCountries.push(countryData);
				}
			});
		},
		// generate all of the markup for the plugin: the selected flag overlay, and the dropdown
		_generateMarkup: function() {
			// Country input
			this.countryInput = $(this.element);
			// containers (mostly for positioning)
			var mainClass = "country-select";
			if (this.options.defaultStyling) {
				mainClass += " " + this.options.defaultStyling;
			}
			this.countryInput.wrap($("<div>", {
				"class": mainClass
			}));
			var flagsContainer = $("<div>", {
				"class": "flag-dropdown"
			}).insertAfter(this.countryInput);
			// currently selected flag (displayed to left of input)
			var selectedFlag = $("<div>", {
				"class": "selected-flag"
			}).appendTo(flagsContainer);
			this.selectedFlagInner = $("<div>", {
				"class": "flag"
			}).appendTo(selectedFlag);
			// CSS triangle
			$("<div>", {
				"class": "arrow"
			}).appendTo(selectedFlag);
			// country list contains: preferred countries, then divider, then all countries
			this.countryList = $("<ul>", {
				"class": "country-list v-hide"
			}).appendTo(flagsContainer);
			if (this.preferredCountries.length) {
				this._appendListItems(this.preferredCountries, "preferred");
				$("<li>", {
					"class": "divider"
				}).appendTo(this.countryList);
			}
			this._appendListItems(this.countries, "");
			// Add the hidden input for the country code
			this.countryCodeInput = $("#"+this.countryInput.attr("id")+"_code");
			if (!this.countryCodeInput) {
				this.countryCodeInput = $('<input type="hidden" id="'+this.countryInput.attr("id")+'_code" name="'+this.countryInput.attr("name")+'_code" value="" />');
				this.countryCodeInput.insertAfter(this.countryInput);
			}
			// now we can grab the dropdown height, and hide it properly
			this.dropdownHeight = this.countryList.outerHeight();
			this.countryList.removeClass("v-hide").addClass("hide");
			// this is useful in lots of places
			this.countryListItems = this.countryList.children(".country");
		},
		// add a country <li> to the countryList <ul> container
		_appendListItems: function(countries, className) {
			// Generate DOM elements as a large temp string, so that there is only
			// one DOM insert event
			var tmp = "";
			// for each country
			$.each(countries, function(i, c) {
console.log(c);
				// open the list item
				tmp += '<li class="country ' + className + '" data-phone-code="' + c.phoneCode + '"  data-country-code="' + c.iso2 + '">';
				// add the flag
				tmp += '<div class="flag ' + c.iso2 + '"></div>';
				// and the country name
				tmp += '<span class="country-name">' + c.name + '</span>';
				// close the list item
				tmp += '</li>';
			});
			this.countryList.append(tmp);
		},
		// set the initial state of the input value and the selected flag
		_setInitialState: function() {
			var flagIsSet = false;
			// If the input is pre-populated, then just update the selected flag
			if (this.countryInput.val()) {
				flagIsSet = this._updateFlagFromInputVal();
			}
			// If the country code input is pre-populated, update the name and the selected flag
			var selectedCode = this.countryCodeInput.val();
			if (selectedCode) {
				this.selectCountry(selectedCode);
			}
			if (!flagIsSet) {
				// flag is not set, so set to the default country
				var defaultCountry;
				// check the defaultCountry option, else fall back to the first in the list
				if (this.options.defaultCountry) {
					defaultCountry = this._getCountryData(this.options.defaultCountry, false);
					// Did we not find the requested default country?
					if (!defaultCountry) {
						defaultCountry = this.preferredCountries.length ? this.preferredCountries[0] : this.countries[0];
					}
				} else {
					defaultCountry = this.preferredCountries.length ? this.preferredCountries[0] : this.countries[0];
				}
				this.defaultCountry = defaultCountry.iso2;
			}
		},
		// initialise the main event listeners: input keyup, and click selected flag
		_initListeners: function() {
			var that = this;
			// Update flag on keyup.
			// Use keyup instead of keypress because we want to update on backspace
			// and instead of keydown because the value hasn't updated when that
			// event is fired.
			// NOTE: better to have this one listener all the time instead of
			// starting it on focus and stopping it on blur, because then you've
			// got two listeners (focus and blur)
			this.countryInput.on("keyup" + this.ns, function() {
				that._updateFlagFromInputVal();
			});
			// toggle country dropdown on click
			var selectedFlag = this.selectedFlagInner.parent();
			selectedFlag.on("click" + this.ns, function(e) {
				// only intercept this event if we're opening the dropdown
				// else let it bubble up to the top ("click-off-to-close" listener)
				// we cannot just stopPropagation as it may be needed to close another instance
				if (that.countryList.hasClass("hide") && !that.countryInput.prop("disabled")) {
					that._showDropdown();
				}
			});
			// Despite above note, added blur to ensure partially spelled country
			// with correctly chosen flag is spelled out on blur. Also, correctly
			// selects flag when field is autofilled
			this.countryInput.on("blur" + this.ns, function() {
				if (that.countryInput.val() != that.getSelectedCountryData().name) {
					that.setCountry(that.countryInput.val());
				}
				that.countryInput.val(that.getSelectedCountryData().name);
			});
		},
		_initAutoCountry: function() {
			if (this.options.initialCountry === "auto") {
				this._loadAutoCountry();
			} else {
				this.selectCountry(this.defaultCountry);
				this.autoCountryDeferred.resolve();
			}
		},
		// perform the geo ip lookup
		_loadAutoCountry: function() {
			var that = this;

			// 3 options:
			// 1) already loaded (we're done)
			// 2) not already started loading (start)
			// 3) already started loading (do nothing - just wait for loading callback to fire)
			if ($.fn[pluginName].autoCountry) {
				this.handleAutoCountry();
			} else if (!$.fn[pluginName].startedLoadingAutoCountry) {
				// don't do this twice!
				$.fn[pluginName].startedLoadingAutoCountry = true;

				if (typeof this.options.geoIpLookup === 'function') {
					this.options.geoIpLookup(function(countryCode) {
						$.fn[pluginName].autoCountry = countryCode.toLowerCase();
						// tell all instances the auto country is ready
						// TODO: this should just be the current instances
						// UPDATE: use setTimeout in case their geoIpLookup function calls this callback straight away (e.g. if they have already done the geo ip lookup somewhere else). Using setTimeout means that the current thread of execution will finish before executing this, which allows the plugin to finish initialising.
						setTimeout(function() {
							$(".country-select input").countrySelect("handleAutoCountry");
						});
					});
				}
			}
		},
		// Focus input and put the cursor at the end
		_focus: function() {
			this.countryInput.focus();
			var input = this.countryInput[0];
			// works for Chrome, FF, Safari, IE9+
			if (input.setSelectionRange) {
				var len = this.countryInput.val().length;
				input.setSelectionRange(len, len);
			}
		},
		// Show the dropdown
		_showDropdown: function() {
			this._setDropdownPosition();
			// update highlighting and scroll to active list item
			var activeListItem = this.countryList.children(".active");
			this._highlightListItem(activeListItem);
			// show it
			this.countryList.removeClass("hide");
			this._scrollTo(activeListItem);
			// bind all the dropdown-related listeners: mouseover, click, click-off, keydown
			this._bindDropdownListeners();
			// update the arrow
			this.selectedFlagInner.parent().children(".arrow").addClass("up");
		},
		// decide where to position dropdown (depends on position within viewport, and scroll)
		_setDropdownPosition: function() {
			var inputTop = this.countryInput.offset().top, windowTop = $(window).scrollTop(),
			dropdownFitsBelow = inputTop + this.countryInput.outerHeight() + this.dropdownHeight < windowTop + $(window).height(), dropdownFitsAbove = inputTop - this.dropdownHeight > windowTop;
			// dropdownHeight - 1 for border
			var cssTop = !dropdownFitsBelow && dropdownFitsAbove ? "-" + (this.dropdownHeight - 1) + "px" : "";
			this.countryList.css("top", cssTop);
		},
		// we only bind dropdown listeners when the dropdown is open
		_bindDropdownListeners: function() {
			var that = this;
			// when mouse over a list item, just highlight that one
			// we add the class "highlight", so if they hit "enter" we know which one to select
			this.countryList.on("mouseover" + this.ns, ".country", function(e) {
				that._highlightListItem($(this));
			});
			// listen for country selection
			this.countryList.on("click" + this.ns, ".country", function(e) {
				that._selectListItem($(this));
			});
			// click off to close
			// (except when this initial opening click is bubbling up)
			// we cannot just stopPropagation as it may be needed to close another instance
			var isOpening = true;
			$("html").on("click" + this.ns, function(e) {
				if (!isOpening) {
					that._closeDropdown();
				}
				isOpening = false;
			});
			// Listen for up/down scrolling, enter to select, or letters to jump to country name.
			// Use keydown as keypress doesn't fire for non-char keys and we want to catch if they
			// just hit down and hold it to scroll down (no keyup event).
			// Listen on the document because that's where key events are triggered if no input has focus
			$(document).on("keydown" + this.ns, function(e) {
				// prevent down key from scrolling the whole page,
				// and enter key from submitting a form etc
				e.preventDefault();
				if (e.which == keys.UP || e.which == keys.DOWN) {
					// up and down to navigate
					that._handleUpDownKey(e.which);
				} else if (e.which == keys.ENTER) {
					// enter to select
					that._handleEnterKey();
				} else if (e.which == keys.ESC) {
					// esc to close
					that._closeDropdown();
				} else if (e.which >= keys.A && e.which <= keys.Z) {
					// upper case letters (note: keyup/keydown only return upper case letters)
					// cycle through countries beginning with that letter
					that._handleLetterKey(e.which);
				}
			});
		},
		// Highlight the next/prev item in the list (and ensure it is visible)
		_handleUpDownKey: function(key) {
			var current = this.countryList.children(".highlight").first();
			var next = key == keys.UP ? current.prev() : current.next();
			if (next.length) {
				// skip the divider
				if (next.hasClass("divider")) {
					next = key == keys.UP ? next.prev() : next.next();
				}
				this._highlightListItem(next);
				this._scrollTo(next);
			}
		},
		// select the currently highlighted item
		_handleEnterKey: function() {
			var currentCountry = this.countryList.children(".highlight").first();
			if (currentCountry.length) {
				this._selectListItem(currentCountry);
			}
		},
		// Iterate through the countries starting with the given letter
		_handleLetterKey: function(key) {
			var letter = String.fromCharCode(key);
			// filter out the countries beginning with that letter
			var countries = this.countryListItems.filter(function() {
				return $(this).text().charAt(0) == letter && !$(this).hasClass("preferred");
			});
			if (countries.length) {
				// if one is already highlighted, then we want the next one
				var highlightedCountry = countries.filter(".highlight").first(), listItem;
				// if the next country in the list also starts with that letter
				if (highlightedCountry && highlightedCountry.next() && highlightedCountry.next().text().charAt(0) == letter) {
					listItem = highlightedCountry.next();
				} else {
					listItem = countries.first();
				}
				// update highlighting and scroll
				this._highlightListItem(listItem);
				this._scrollTo(listItem);
			}
		},
		// Update the selected flag using the input's current value
		_updateFlagFromInputVal: function() {
			var that = this;
			// try and extract valid country from input
			var value = this.countryInput.val().replace(/(?=[() ])/g, '\\');
			if (value) {
				var countryCodes = [];
				var matcher = new RegExp("^"+value, "i");
				for (var i = 0; i < this.countries.length; i++) {
					if (this.countries[i].name.match(matcher)) {
						countryCodes.push(this.countries[i].iso2);
					}
				}
				// Check if one of the matching countries is already selected
				var alreadySelected = false;
				$.each(countryCodes, function(i, c) {
					if (that.selectedFlagInner.hasClass(c)) {
						alreadySelected = true;
					}
				});
				if (!alreadySelected) {
					this._selectFlag(countryCodes[0]);
					this.countryCodeInput.val(countryCodes[0]).trigger("change");
				}
				// Matching country found
				return true;
			}
			// No match found
			return false;
		},
		// remove highlighting from other list items and highlight the given item
		_highlightListItem: function(listItem) {
			this.countryListItems.removeClass("highlight");
			listItem.addClass("highlight");
		},
		// find the country data for the given country code
		// the ignoreOnlyCountriesOption is only used during init() while parsing the onlyCountries array
		_getCountryData: function(countryCode, ignoreOnlyCountriesOption) {
			var countryList = ignoreOnlyCountriesOption ? allCountries : this.countries;
			for (var i = 0; i < countryList.length; i++) {
				if (countryList[i].iso2 == countryCode) {
					return countryList[i];
				}
			}
			return null;
		},
		// update the selected flag and the active list item
		_selectFlag: function(countryCode) {
			if (! countryCode) {
				return false;
			}
			this.selectedFlagInner.attr("class", "flag " + countryCode);
			// update the title attribute
			var countryData = this._getCountryData(countryCode);
			this.selectedFlagInner.parent().attr("title", countryData.name);
			this.selectedFlagInner.parent().attr("country-code", countryData.phoneCode);
			// update the active list item
			var listItem = this.countryListItems.children(".flag." + countryCode).first().parent();
			this.countryListItems.removeClass("active");
			listItem.addClass("active");
		},
		// called when the user selects a list item from the dropdown
		_selectListItem: function(listItem) {
			// update selected flag and active list item
			var countryCode = listItem.attr("data-country-code");
			var countryPhone = listItem.attr("data-phone-code");
			this._selectFlag(countryCode);
			this._closeDropdown();
			// update input value
			this._updateName(countryCode);
			this._updateName(countryCode);
			this.countryInput.trigger("change");
			this.countryCodeInput.trigger("change");
			// focus the input
			this._focus();
		},
		// close the dropdown and unbind any listeners
		_closeDropdown: function() {
			this.countryList.addClass("hide");
			// update the arrow
			this.selectedFlagInner.parent().children(".arrow").removeClass("up");
			// unbind event listeners
			$(document).off("keydown" + this.ns);
			$("html").off("click" + this.ns);
			// unbind both hover and click listeners
			this.countryList.off(this.ns);
		},
		// check if an element is visible within its container, else scroll until it is
		_scrollTo: function(element) {
			if (!element || !element.offset()) {
				return;
			}
			var container = this.countryList, containerHeight = container.height(), containerTop = container.offset().top, containerBottom = containerTop + containerHeight, elementHeight = element.outerHeight(), elementTop = element.offset().top, elementBottom = elementTop + elementHeight, newScrollTop = elementTop - containerTop + container.scrollTop();
			if (elementTop < containerTop) {
				// scroll up
				container.scrollTop(newScrollTop);
			} else if (elementBottom > containerBottom) {
				// scroll down
				var heightDifference = containerHeight - elementHeight;
				container.scrollTop(newScrollTop - heightDifference);
			}
		},
		// Replace any existing country name with the new one
		_updateName: function(countryCode) {
			this.countryCodeInput.val(countryCode).trigger("change");
			this.countryInput.val(this._getCountryData(countryCode).name);
		},
		/********************
		 *  PUBLIC METHODS
		 ********************/
		// this is called when the geoip call returns
		handleAutoCountry: function() {
			if (this.options.initialCountry === "auto") {
				// we must set this even if there is an initial val in the input: in case the initial val is invalid and they delete it - they should see their auto country
				this.defaultCountry = $.fn[pluginName].autoCountry;
				// if there's no initial value in the input, then update the flag
				if (!this.countryInput.val()) {
					this.selectCountry(this.defaultCountry);
				}
				this.autoCountryDeferred.resolve();
			}
		},
		// get the country data for the currently selected flag
		getSelectedCountryData: function() {
			// rely on the fact that we only set 2 classes on the selected flag element:
			// the first is "flag" and the second is the 2-char country code
			var countryCode = this.selectedFlagInner.attr("class").split(" ")[1];
			return this._getCountryData(countryCode);
		},
		// update the selected flag
		selectCountry: function(countryCode) {
			countryCode = countryCode.toLowerCase();
			// check if already selected
			if (!this.selectedFlagInner.hasClass(countryCode)) {
				this._selectFlag(countryCode);
				this._updateName(countryCode);
			}
		},
		// set the input value and update the flag
		setCountry: function(country) {
			this.countryInput.val(country);
			this._updateFlagFromInputVal();
		},
		// remove plugin
		destroy: function() {
			// stop listeners
			this.countryInput.off(this.ns);
			this.selectedFlagInner.parent().off(this.ns);
			// remove markup
			var container = this.countryInput.parent();
			container.before(this.countryInput).remove();
		}
	};
	// adapted to allow public functions
	// using https://github.com/jquery-boilerplate/jquery-boilerplate/wiki/Extending-jQuery-Boilerplate
	$.fn[pluginName] = function(options) {
		var args = arguments;
		// Is the first parameter an object (options), or was omitted,
		// instantiate a new instance of the plugin.
		if (options === undefined || typeof options === "object") {
			return this.each(function() {
				if (!$.data(this, "plugin_" + pluginName)) {
					$.data(this, "plugin_" + pluginName, new Plugin(this, options));
				}
			});
		} else if (typeof options === "string" && options[0] !== "_" && options !== "init") {
			// If the first parameter is a string and it doesn't start
			// with an underscore or "contains" the `init`-function,
			// treat this as a call to a public method.
			// Cache the method call to make it possible to return a value
			var returns;
			this.each(function() {
				var instance = $.data(this, "plugin_" + pluginName);
				// Tests that there's already a plugin-instance
				// and checks that the requested public method exists
				if (instance instanceof Plugin && typeof instance[options] === "function") {
					// Call the method of our plugin instance,
					// and pass it the supplied arguments.
					returns = instance[options].apply(instance, Array.prototype.slice.call(args, 1));
				}
				// Allow instances to be destroyed via the 'destroy' method
				if (options === "destroy") {
					$.data(this, "plugin_" + pluginName, null);
				}
			});
			// If the earlier cached method gives a value back return the value,
			// otherwise return this to preserve chainability.
			return returns !== undefined ? returns : this;
		}
	};
	/********************
   *  STATIC METHODS
   ********************/
	// get the country data object
	$.fn[pluginName].getCountryData = function() {
		return allCountries;
	};
	// set the country data object
	$.fn[pluginName].setCountryData = function(obj) {
		allCountries = obj;
	};
	// Tell JSHint to ignore this warning: "character may get silently deleted by one or more browsers"
	// jshint -W100
	// Array of country objects for the flag dropdown.
	// Each contains a name and country code (ISO 3166-1 alpha-2).
	//
	// Note: using single char property names to keep filesize down
	// n = name
	// i = iso2 (2-char country code)
	var allCountries = $.each([{countryName:"Afghanistan",iso2:"AF",phoneCode:"93"},{countryName:"Albania",iso2:"AL",phoneCode:"355"},{countryName:"Algeria",iso2:"DZ",phoneCode:"213"},{countryName:"American Samoa",iso2:"AS",phoneCode:"1 684"},{countryName:"Andorra",iso2:"AD",phoneCode:"376"},{countryName:"Angola",iso2:"AO",phoneCode:"244"},{countryName:"Anguilla",iso2:"AI",phoneCode:"1 264"},{countryName:"Antarctica",iso2:"AQ",phoneCode:"672"},{countryName:"Antigua and Barbuda",iso2:"AG",phoneCode:"1 268"},{countryName:"Argentina",iso2:"AR",phoneCode:"54"},{countryName:"Armenia",iso2:"AM",phoneCode:"374"},{countryName:"Aruba",iso2:"AW",phoneCode:"297"},{countryName:"Australia",iso2:"AU",phoneCode:"61"},{countryName:"Austria",iso2:"AT",phoneCode:"43"},{countryName:"Azerbaijan",iso2:"AZ",phoneCode:"994"},{countryName:"Bahamas",iso2:"BS",phoneCode:"1 242"},{countryName:"Bahrain",iso2:"BH",phoneCode:"973"},{countryName:"Bangladesh",iso2:"BD",phoneCode:"880"},{countryName:"Barbados",iso2:"BB",phoneCode:"1 246"},{countryName:"Belarus",iso2:"BY",phoneCode:"375"},{countryName:"Belgium",iso2:"BE",phoneCode:"32"},{countryName:"Belize",iso2:"BZ",phoneCode:"501"},{countryName:"Benin",iso2:"BJ",phoneCode:"229"},{countryName:"Bermuda",iso2:"BM",phoneCode:"1 441"},{countryName:"Bhutan",iso2:"BT",phoneCode:"975"},{countryName:"Bolivia",iso2:"BO",phoneCode:"591"},{countryName:"Bosnia and Herzegovina",iso2:"BA",phoneCode:"387"},{countryName:"Botswana",iso2:"BW",phoneCode:"267"},{countryName:"Brazil",iso2:"BR",phoneCode:"55"},{countryName:"British Virgin Islands",iso2:"VG",phoneCode:"1 284"},{countryName:"Brunei",iso2:"BN",phoneCode:"673"},{countryName:"Bulgaria",iso2:"BG",phoneCode:"359"},{countryName:"Burkina Faso",iso2:"BF",phoneCode:"226"},{countryName:"Burma (Myanmar)",iso2:"MM",phoneCode:"95"},{countryName:"Burundi",iso2:"BI",phoneCode:"257"},{countryName:"Cambodia",iso2:"KH",phoneCode:"855"},{countryName:"Cameroon",iso2:"CM",phoneCode:"237"},{countryName:"Canada",iso2:"CA",phoneCode:"1"},{countryName:"Cape Verde",iso2:"CV",phoneCode:"238"},{countryName:"Cayman Islands",iso2:"KY",phoneCode:"1 345"},{countryName:"Central African Republic",iso2:"CF",phoneCode:"236"},{countryName:"Chad",iso2:"TD",phoneCode:"235"},{countryName:"Chile",iso2:"CL",phoneCode:"56"},{countryName:"China",iso2:"CN",phoneCode:"86"},{countryName:"Christmas Island",iso2:"CX",phoneCode:"61"},{countryName:"Cocos (Keeling) Islands",iso2:"CC",phoneCode:"61"},{countryName:"Colombia",iso2:"CO",phoneCode:"57"},{countryName:"Comoros",iso2:"KM",phoneCode:"269"},{countryName:"Cook Islands",iso2:"CK",phoneCode:"682"},{countryName:"Costa Rica",iso2:"CR",phoneCode:"506"},{countryName:"Croatia",iso2:"HR",phoneCode:"385"},{countryName:"Cuba",iso2:"CU",phoneCode:"53"},{countryName:"Cyprus",iso2:"CY",phoneCode:"357"},{countryName:"Czech Republic",iso2:"CZ",phoneCode:"420"},{countryName:"Democratic Republic of the Congo",iso2:"CD",phoneCode:"243"},{countryName:"Denmark",iso2:"DK",phoneCode:"45"},{countryName:"Djibouti",iso2:"DJ",phoneCode:"253"},{countryName:"Dominica",iso2:"DM",phoneCode:"1 767"},{countryName:"Dominican Republic",iso2:"DO",phoneCode:"1 809"},{countryName:"Ecuador",iso2:"EC",phoneCode:"593"},{countryName:"Egypt",iso2:"EG",phoneCode:"20"},{countryName:"El Salvador",iso2:"SV",phoneCode:"503"},{countryName:"Equatorial Guinea",iso2:"GQ",phoneCode:"240"},{countryName:"Eritrea",iso2:"ER",phoneCode:"291"},{countryName:"Estonia",iso2:"EE",phoneCode:"372"},{countryName:"Ethiopia",iso2:"ET",phoneCode:"251"},{countryName:"Falkland Islands",iso2:"FK",phoneCode:"500"},{countryName:"Faroe Islands",iso2:"FO",phoneCode:"298"},{countryName:"Fiji",iso2:"FJ",phoneCode:"679"},{countryName:"Finland",iso2:"FI",phoneCode:"358"},{countryName:"France",iso2:"FR",phoneCode:"33"},{countryName:"French Polynesia",iso2:"PF",phoneCode:"689"},{countryName:"Gabon",iso2:"GA",phoneCode:"241"},{countryName:"Gambia",iso2:"GM",phoneCode:"220"},{countryName:"Gaza Strip",iso2:"",phoneCode:"970"},{countryName:"Georgia",iso2:"GE",phoneCode:"995"},{countryName:"Germany",iso2:"DE",phoneCode:"49"},{countryName:"Ghana",iso2:"GH",phoneCode:"233"},{countryName:"Gibraltar",iso2:"GI",phoneCode:"350"},{countryName:"Greece",iso2:"GR",phoneCode:"30"},{countryName:"Greenland",iso2:"GL",phoneCode:"299"},{countryName:"Grenada",iso2:"GD",phoneCode:"1 473"},{countryName:"Guam",iso2:"GU",phoneCode:"1 671"},{countryName:"Guatemala",iso2:"GT",phoneCode:"502"},{countryName:"Guinea",iso2:"GN",phoneCode:"224"},{countryName:"Guinea-Bissau",iso2:"GW",phoneCode:"245"},{countryName:"Guyana",iso2:"GY",phoneCode:"592"},{countryName:"Haiti",iso2:"HT",phoneCode:"509"},{countryName:"Holy See (Vatican City)",iso2:"VA",phoneCode:"39"},{countryName:"Honduras",iso2:"HN",phoneCode:"504"},{countryName:"Hong Kong",iso2:"HK",phoneCode:"852"},{countryName:"Hungary",iso2:"HU",phoneCode:"36"},{countryName:"Iceland",iso2:"IS",phoneCode:"354"},{countryName:"India",iso2:"IN",phoneCode:"91"},{countryName:"Indonesia",iso2:"ID",phoneCode:"62"},{countryName:"Iran",iso2:"IR",phoneCode:"98"},{countryName:"Iraq",iso2:"IQ",phoneCode:"964"},{countryName:"Ireland",iso2:"IE",phoneCode:"353"},{countryName:"Isle of Man",iso2:"IM",phoneCode:"44"},{countryName:"Israel",iso2:"IL",phoneCode:"972"},{countryName:"Italy",iso2:"IT",phoneCode:"39"},{countryName:"Ivory Coast",iso2:"CI",phoneCode:"225"},{countryName:"Jamaica",iso2:"JM",phoneCode:"1 876"},{countryName:"Japan",iso2:"JP",phoneCode:"81"},{countryName:"Jordan",iso2:"JO",phoneCode:"962"},{countryName:"Kazakhstan",iso2:"KZ",phoneCode:"7"},{countryName:"Kenya",iso2:"KE",phoneCode:"254"},{countryName:"Kiribati",iso2:"KI",phoneCode:"686"},{countryName:"Kosovo",iso2:"",phoneCode:"381"},{countryName:"Kuwait",iso2:"KW",phoneCode:"965"},{countryName:"Kyrgyzstan",iso2:"KG",phoneCode:"996"},{countryName:"Laos",iso2:"LA",phoneCode:"856"},{countryName:"Latvia",iso2:"LV",phoneCode:"371"},{countryName:"Lebanon",iso2:"LB",phoneCode:"961"},{countryName:"Lesotho",iso2:"LS",phoneCode:"266"},{countryName:"Liberia",iso2:"LR",phoneCode:"231"},{countryName:"Libya",iso2:"LY",phoneCode:"218"},{countryName:"Liechtenstein",iso2:"LI",phoneCode:"423"},{countryName:"Lithuania",iso2:"LT",phoneCode:"370"},{countryName:"Luxembourg",iso2:"LU",phoneCode:"352"},{countryName:"Macau",iso2:"MO",phoneCode:"853"},{countryName:"Macedonia",iso2:"MK",phoneCode:"389"},{countryName:"Madagascar",iso2:"MG",phoneCode:"261"},{countryName:"Malawi",iso2:"MW",phoneCode:"265"},{countryName:"Malaysia",iso2:"MY",phoneCode:"60"},{countryName:"Maldives",iso2:"MV",phoneCode:"960"},{countryName:"Mali",iso2:"ML",phoneCode:"223"},{countryName:"Malta",iso2:"MT",phoneCode:"356"},{countryName:"Marshall Islands",iso2:"MH",phoneCode:"692"},{countryName:"Mauritania",iso2:"MR",phoneCode:"222"},{countryName:"Mauritius",iso2:"MU",phoneCode:"230"},{countryName:"Mayotte",iso2:"YT",phoneCode:"262"},{countryName:"Mexico",iso2:"MX",phoneCode:"52"},{countryName:"Micronesia",iso2:"FM",phoneCode:"691"},{countryName:"Moldova",iso2:"MD",phoneCode:"373"},{countryName:"Monaco",iso2:"MC",phoneCode:"377"},{countryName:"Mongolia",iso2:"MN",phoneCode:"976"},{countryName:"Montenegro",iso2:"ME",phoneCode:"382"},{countryName:"Montserrat",iso2:"MS",phoneCode:"1 664"},{countryName:"Morocco",iso2:"MA",phoneCode:"212"},{countryName:"Mozambique",iso2:"MZ",phoneCode:"258"},{countryName:"Namibia",iso2:"NA",phoneCode:"264"},{countryName:"Nauru",iso2:"NR",phoneCode:"674"},{countryName:"Nepal",iso2:"NP",phoneCode:"977"},{countryName:"Netherlands",iso2:"NL",phoneCode:"31"},{countryName:"Netherlands Antilles",iso2:"AN",phoneCode:"599"},{countryName:"New Caledonia",iso2:"NC",phoneCode:"687"},{countryName:"New Zealand",iso2:"NZ",phoneCode:"64"},{countryName:"Nicaragua",iso2:"NI",phoneCode:"505"},{countryName:"Niger",iso2:"NE",phoneCode:"227"},{countryName:"Nigeria",iso2:"NG",phoneCode:"234"},{countryName:"Niue",iso2:"NU",phoneCode:"683"},{countryName:"Norfolk Island",iso2:"",phoneCode:"672"},{countryName:"North Korea",iso2:"KP",phoneCode:"850"},{countryName:"Northern Mariana Islands",iso2:"MP",phoneCode:"1 670"},{countryName:"Norway",iso2:"NO",phoneCode:"47"},{countryName:"Oman",iso2:"OM",phoneCode:"968"},{countryName:"Pakistan",iso2:"PK",phoneCode:"92"},{countryName:"Palau",iso2:"PW",phoneCode:"680"},{countryName:"Panama",iso2:"PA",phoneCode:"507"},{countryName:"Papua New Guinea",iso2:"PG",phoneCode:"675"},{countryName:"Paraguay",iso2:"PY",phoneCode:"595"},{countryName:"Peru",iso2:"PE",phoneCode:"51"},{countryName:"Philippines",iso2:"PH",phoneCode:"63"},{countryName:"Pitcairn Islands",iso2:"PN",phoneCode:"870"},{countryName:"Poland",iso2:"PL",phoneCode:"48"},{countryName:"Portugal",iso2:"PT",phoneCode:"351"},{countryName:"Puerto Rico",iso2:"PR",phoneCode:"1"},{countryName:"Qatar",iso2:"QA",phoneCode:"974"},{countryName:"Republic of the Congo",iso2:"CG",phoneCode:"242"},{countryName:"Romania",iso2:"RO",phoneCode:"40"},{countryName:"Russia",iso2:"RU",phoneCode:"7"},{countryName:"Rwanda",iso2:"RW",phoneCode:"250"},{countryName:"Saint Barthelemy",iso2:"BL",phoneCode:"590"},{countryName:"Saint Helena",iso2:"SH",phoneCode:"290"},{countryName:"Saint Kitts and Nevis",iso2:"KN",phoneCode:"1 869"},{countryName:"Saint Lucia",iso2:"LC",phoneCode:"1 758"},{countryName:"Saint Martin",iso2:"MF",phoneCode:"1 599"},{countryName:"Saint Pierre and Miquelon",iso2:"PM",phoneCode:"508"},{countryName:"Saint Vincent and the Grenadines",iso2:"VC",phoneCode:"1 784"},{countryName:"Samoa",iso2:"WS",phoneCode:"685"},{countryName:"San Marino",iso2:"SM",phoneCode:"378"},{countryName:"Sao Tome and Principe",iso2:"ST",phoneCode:"239"},{countryName:"Saudi Arabia",iso2:"SA",phoneCode:"966"},{countryName:"Senegal",iso2:"SN",phoneCode:"221"},{countryName:"Serbia",iso2:"RS",phoneCode:"381"},{countryName:"Seychelles",iso2:"SC",phoneCode:"248"},{countryName:"Sierra Leone",iso2:"SL",phoneCode:"232"},{countryName:"Singapore",iso2:"SG",phoneCode:"65"},{countryName:"Slovakia",iso2:"SK",phoneCode:"421"},{countryName:"Slovenia",iso2:"SI",phoneCode:"386"},{countryName:"Solomon Islands",iso2:"SB",phoneCode:"677"},{countryName:"Somalia",iso2:"SO",phoneCode:"252"},{countryName:"South Africa",iso2:"ZA",phoneCode:"27"},{countryName:"South Korea",iso2:"KR",phoneCode:"82"},{countryName:"Spain",iso2:"ES",phoneCode:"34"},{countryName:"Sri Lanka",iso2:"LK",phoneCode:"94"},{countryName:"Sudan",iso2:"SD",phoneCode:"249"},{countryName:"Suriname",iso2:"SR",phoneCode:"597"},{countryName:"Swaziland",iso2:"SZ",phoneCode:"268"},{countryName:"Sweden",iso2:"SE",phoneCode:"46"},{countryName:"Switzerland",iso2:"CH",phoneCode:"41"},{countryName:"Syria",iso2:"SY",phoneCode:"963"},{countryName:"Taiwan",iso2:"TW",phoneCode:"886"},{countryName:"Tajikistan",iso2:"TJ",phoneCode:"992"},{countryName:"Tanzania",iso2:"TZ",phoneCode:"255"},{countryName:"Thailand",iso2:"TH",phoneCode:"66"},{countryName:"Timor-Leste",iso2:"TL",phoneCode:"670"},{countryName:"Togo",iso2:"TG",phoneCode:"228"},{countryName:"Tokelau",iso2:"TK",phoneCode:"690"},{countryName:"Tonga",iso2:"TO",phoneCode:"676"},{countryName:"Trinidad and Tobago",iso2:"TT",phoneCode:"1 868"},{countryName:"Tunisia",iso2:"TN",phoneCode:"216"},{countryName:"Turkey",iso2:"TR",phoneCode:"90"},{countryName:"Turkmenistan",iso2:"TM",phoneCode:"993"},{countryName:"Turks and Caicos Islands",iso2:"TC",phoneCode:"1 649"},{countryName:"Tuvalu",iso2:"TV",phoneCode:"688"},{countryName:"Uganda",iso2:"UG",phoneCode:"256"},{countryName:"Ukraine",iso2:"UA",phoneCode:"380"},{countryName:"United Arab Emirates",iso2:"AE",phoneCode:"971"},{countryName:"United Kingdom",iso2:"GB",phoneCode:"44"},{countryName:"United States",iso2:"US",phoneCode:"1"},{countryName:"Uruguay",iso2:"UY",phoneCode:"598"},{countryName:"US Virgin Islands",iso2:"VI",phoneCode:"1 340"},{countryName:"Uzbekistan",iso2:"UZ",phoneCode:"998"},{countryName:"Vanuatu",iso2:"VU",phoneCode:"678"},{countryName:"Venezuela",iso2:"VE",phoneCode:"58"},{countryName:"Vietnam",iso2:"VN",phoneCode:"84"},{countryName:"Wallis and Futuna",iso2:"WF",phoneCode:"681"},{countryName:"West Bank",iso2:"",phoneCode:"970"},{countryName:"Yemen",iso2:"YE",phoneCode:"967"},{countryName:"Zambia",iso2:"ZM",phoneCode:"260"},{countryName:"Zimbabwe",iso2:"ZW",phoneCode:"263"}]
        , function(i, c) {
		c.name = c.countryName;
		c.iso2 = c.iso2.toLowerCase();
		c.iso3 = c.phoneCode;
		delete c.countryName;
		delete c.iso2.toLowerCase();
		delete c.iso3;
	});
});


