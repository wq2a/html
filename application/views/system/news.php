<?php $this->load->view('system/home');


echo '<div class="my_div1" style="margin-top:30px;">';


echo form_open('system/addnews');
echo '<input class="my_button" class="my_input" type="submit"></input>';

echo '<input placeholder="标题" class="my_input" name="news_title" type="text" style="width:60%;position:relative;float:left;" ></input>';
echo '<input placeholder="类型" class="my_input" name="type" type="text" style="width:60%;position:relative;float:left;" ></input>';
echo '<input placeholder="列表图片" class="my_input" name="image" type="text" style="width:100%;position:relative;float:left;"></input>';
echo '<input placeholder="链接" class="my_input" name="link" type="text" style="width:100%;position:relative;float:left;"></input>';
echo '<input placeholder="图片" class="my_input" name="images" type="text" style="width:100%;position:relative;float:left;"></input>';
echo '<textarea placeholder="内容" class="my_input" name="detail" type="textarea" style="width:60%;height:600px;position:relative;float:left;"></textarea>';
echo form_close();


echo '</div>';

?>