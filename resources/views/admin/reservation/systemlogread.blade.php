<textarea style="width:49%" rows=55 disabled><?php $json2 = json_encode(json_decode($log->old_value), JSON_PRETTY_PRINT); echo $json2; ?></textarea>
<textarea style="width:50%" rows=55 disabled><?php $json2 = json_encode(json_decode($log->new_value), JSON_PRETTY_PRINT); echo $json2; ?></textarea>

