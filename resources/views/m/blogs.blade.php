@extends('m.layouts.master')
@section('title')@endsection
@section('content')
<div id="content">
    <div class="content-wrap page-news-list">
        <div class="subsite-banner">
            <img src="img/subsite-banner-5.jpg">
        </div>
        <div class="subsite subsite-with-banner">
            <div class="row">
                <div class="col-md-12">
                    <div class="subsite-heading">
                        Travel Guides
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-form search-content">
                        <div class="search-wrapper ">
                            <input id="search" placeholder="Search...">
                            <button class="ssubmit" type="submit" name="search_submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row news-row">
                <div class="col-md-12">
                    <div class="news-card">
                        <div class="nc-top">
                            <div class="nc-left">
                                <div class="ncl-image">
                                    <img src="img/news3.jpg" alt="image">
                                </div>
                            </div>
                            <div class="nc-right">
                                <div class="ncr-row-a">
                                    Purchase Your Flight on Tuesday Afternoon
                                </div>
                                <div class="ncr-row-b">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row news-row">
                <div class="col-md-12">
                    <div class="news-card">
                        <div class="nc-top">
                            <div class="nc-left">
                                <div class="ncl-image">
                                    <img src="img/news2.jpg" alt="image">
                                </div>
                            </div>
                            <div class="nc-right">
                                <div class="ncr-row-a">
                                    How to survive on a desert island
                                </div>
                                <div class="ncr-row-b">
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row news-row">
                <div class="col-md-12">
                    <div class="news-card">
                        <div class="nc-top">
                            <div class="nc-left">
                                <div class="ncl-image">
                                    <img src="img/destination5.jpg" alt="image">
                                </div>
                            </div>
                            <div class="nc-right">
                                <div class="ncr-row-a">
                                    Travel by yourself at least once
                                </div>
                                <div class="ncr-row-b">
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row news-row">
                <div class="col-md-12">
                    <div class="news-card">
                        <div class="nc-top">
                            <div class="nc-left">
                                <div class="ncl-image">
                                    <img src="img/destination1.jpg" alt="image">
                                </div>
                            </div>
                            <div class="nc-right">
                                <div class="ncr-row-a">
                                    10 Ways to Save Money On Your Next Trip
                                </div>
                                <div class="ncr-row-b">
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row news-row">
                <div class="col-md-12">
                    <div class="news-card">
                        <div class="nc-top">
                            <div class="nc-left">
                                <div class="ncl-image">
                                    <img src="img/news1.jpg" alt="image">
                                </div>
                            </div>
                            <div class="nc-right">
                                <div class="ncr-row-a">
                                    Everything You Need To Know About Car Hire Tips
                                </div>
                                <div class="ncr-row-b">
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row car-row pagination-row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
