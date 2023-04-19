$(document).ready(function() {
    $(".buy").click(function() {
       let path = 'purchase.php?action=';
       path += this.id;
       window.location.href=path;
    });
   $(".sell").click(function() {
      let path = 'purchase.php?action=';
      path += this.id;
      window.location.href=path;
   });
});
