<?php wp_footer(); 

?>



<footer>

<!-- Home PAge -->

<?php if(is_front_page()) {?>
 <div class="container">
    <div class="foot-btm">
      <h4>FOLLOW US</h4>
      <ul>
        <li><i class="fa fa-facebook-square"></i><a href="<?php echo ((get_option('shreesava_facebook_url'))?get_option('shreesava_facebook_url'):'#') ?>" target="_blank">Join us on Facebook</a></li>
        <li><i class="fa fa-twitter-square"></i><a href="<?php echo ((get_option('shreesava_twitter_url'))?get_option('shreesava_twitter_url'):'#') ?>" target="_blank">Join us on Twitter</a></li>
        <li><i class="fa fa-instagram"></i><a href="<?php echo ((get_option('shreesava_instagram_url'))?get_option('shreesava_instagram_url'):'#') ?>" target="_blank">Join us on Instagram</a></li>
      </ul>
      <ul class="foot-top">
        <li><a href="<?php echo get_permalink(146); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo get_permalink(149); ?>">Disclaimer</a></li>
      </ul>
    </div>
  </div>
  <?php  
      } 
   ?>
<!-- Home Page -->


  <div class="footer-btm">
    <div class="container">
      <div class="pull-left"><?php echo ((get_option('shreesava_footer'))?get_option('shreesava_footer'):'') ?></div>
      <div class="pull-right">DESIGN BY <a href="https://www.webplusinfotech.net/" target="_blank">WEBPLUS</a></div>
    </div>
  </div>

</footer>


<script type="text/javascript">  
  $(document).ready(function(){
      $('.navbar-toggle').click(function(){   
        $(this).toggleClass('open');
      });


  $('.menu-10').append("<span class='bar'></span>"); // create new element
      var $bar = $('.menu-10 .bar');
      var barLeft =  $('.menu-10 li.active').position().left;
      var barWidth = $('.menu-10 li.active').width();
      $bar.css('width', barWidth).css('left', barLeft);

  // get hover menu item position and width
    $('.menu-10 li').click(function() {
        $bar.css('width', $(this).width()).css('left', $(this).position().left);
    });

  // return to the original position of the active list item
    $('.menu-10').mouseleave(function() {
        $bar.css('width', barWidth).css('left', barLeft);  
    });

  // сhanging the active menu item
    $('.menu-10 li').click(function() {
      barLeft =  $(this).position().left;
      barWidth = $(this).width();
      $('.menu-10 li').removeClass('active');      
    });

});
  
</script>

</body>
</html>