<?php 

// Takk til http://www.vanseodesign.com/css/simple-navigation-bar-with-css-and-xhtml/ for menybaren!

?>

<style type="text/css">

ul#list-nav {
  list-style:none;
  margin:20px;
  padding:0;
  width:525px
}

ul#list-nav li {
  display:inline
}

ul#list-nav li a {
  text-decoration:none;
  padding:5px 0;
  width:100px;
  background:#485e49;
  color:#eee;
  float:left;
  text-align:center;
  border-left:1px solid #fff;
}

ul#list-nav li a:hover {
  background:#a2b3a1;
  color:#000
}

</style>

<ul id="list-nav">
  <li><a href="?page=hme">Hjem</a></li>
  <li><a href="?page=nyskole">Ny skole</a></li>
  <li><a href="?page=oppskole">Oppdater Skole</a></li>
  <li><a href="?page=stats">Statistikk</a></li>

  
</ul>