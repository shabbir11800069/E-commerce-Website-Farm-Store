<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
   <!-- Stylesheets/CDN Area Start ============================================= -->
   <?php
   $page = 'index';
   require_once('includes/cdn.php');
   ?>
   <!-- Stylesheets/CDN Area End ============================================= -->
</head>

<body class="stretched">
   <!-- Document Wrapper ============================================= -->
   <div id="wrapper" class="clearfix">

      <!-- On LOad Modal Area Start-->
      <?php
      require_once('includes/onloadmodal.php');
      ?>
      <!-- On LOad Modal Area End-->

      <!-- Top Bar Area Start ============================================= -->
      <?php
      require_once('includes/topbar.php');
      ?>
      <!-- Top Bar Area End ============================================= -->

      <!-- Navbar Area Start ============================================= -->
      <?php
      require_once('includes/navbar.php');
      ?>
      <!-- Navbar Area end -->

      <!--Banner Slider area start ============================================= -->
      <?php
      require_once('includes/mainslider.php');
      ?>
      <!-- Banner Slider area End -->

      <!-- Content ============================================= -->
      <section id="content">
         <div class="content-wrap">
            <div class="fancy-title title-dotted-border topmargin-sm mb-4 title-center">
               <h2>Best Products(Based on Sub Catagories)</h2>
            </div>
            <hr>
            <div class="container-fluid clearfix">
               <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                     <h3 class="text-center">Sub Catagories</h3>
                     <hr>
                     <ul class="list-group">
                        <?php
                        $cid = $_GET['cid'];
                        $query = "SELECT subcategory.id as sid,subcategory.name,subcategory.cat_id,category.id as cid FROM category,subcategory WHERE category.id = subcategory.cat_id AND category.id = '$cid'";
                        $data = mysqli_query($con, $query);
                        if (mysqli_num_rows($data) > 0) {
                           while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                             <li class="list-group-item"><a href="SubCatagory?sid=<?php echo $row["sid"]; ?>&cid=<?php echo $row["cid"]; ?>"><b><?php echo $row['name']; ?></b></a></li>
                        <?php
                           }
                        }
                        ?>
                     </ul>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                     <h3 class="text-center">Products</h3>
                     <hr>

                     <div class="row grid-6">
                        <?php
                        error_reporting(0);
                        $page = '';
                        $id = $_GET['sid'];
                        $page = $_GET['page'];
                        if ($page == "" || $page == "1") {
                           $page1 = 0;
                        } else {
                           $page1 = ($page * 12) - 12;
                        }
                        $sql = "SELECT * FROM subcategory,product WHERE subcategory.id= product.sid AND subcategory.id = '$id' LIMIT $page1,12";
                        $result = mysqli_query($con, $sql);
                        $video_id = '';
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                           <div class="col-lg-2 col-md-3 col-6 px-2">
                              <div class="product iproduct clearfix">
                                 <div class="product-image">
                                    <a href="Product?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>"><img src="<?php echo $row['pimg']; ?>" alt="Image 1" style="width:200px;height:200px;"></a>
                                    <a href="Product?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>"><img src="<?php echo $row['pimg']; ?>" alt="Image 1" style="width:200px;height:200px;"></a>
                                    <div class="sale-flash" style="background-color: #42BD31;color:black;">
                                      <?php
                                      if ($row['discount'] > 0) {
                                      ?>
                                         <span class="lead"><span class="badge badge-success" style="color:#fff;"><?php echo $row['discount'].' % Off' ?></span></span>
                                      <?php
                                      } else {
                                      ?>
                                         <span><span class="badge">Sale!</span></span>
                                      <?php
                                      }
                                      ?>
                                   </div>
                                    <div class="product-overlay" align="center">
                                       <?php
                                       if ($row['stock'] > 0) {
                                       ?>
                                          <a href="Product?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>" class="add-to-cart">
                                             <i class="icon-shopping-cart"></i>
                                          </a>
                                       <?php
                                       } else {
                                       ?>
                                          <del><span style="color: #42BD31;"><b> Out of stock</b></span></del>
                                       <?php
                                       }
                                       ?>
                                    </div>
                                 </div>
                                 <div class="product-desc">
                                    <div class="product-title mb-1">
                                       <h3>
                                          <center><a href="Product?id=<?php echo $row["id"]; ?>"><?php echo $row['pname']; ?></a></center>
                                       </h3>
                                       <a href="Product?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>" class="btn btn-block text-dark mt-1" style="background-color: #42bd31;"><b><i class="icon-shopping-cart"></i>&nbsp;Add to cart&nbsp;<i class="icon-shopping-cart"></i></b></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php
                        }
                        ?>
                     </div>
                     <?php
                     //this is for counting number of page
                     $id = $_GET['sid'];
                     $query1 = "SELECT * FROM subcategory,product WHERE subcategory.id= product.sid AND subcategory.id = '$id'";
                     $result1 = mysqli_query($con, $query1);
                     $count = mysqli_num_rows($result1);
                     $row = mysqli_fetch_array($result1);
                     $a = $count / 12;

                     $a =  ceil($a);

                     echo "<br>";

                     for ($b = 1; $b <= $a; $b++) {
                     ?>
                        <a href="SubCatagory?page=<?php echo $b; ?>&sid=<?php echo $id; ?>" class="btn btn-warning text-dark"><?php echo $b ?></a>
                     <?php
                     }
                     ?>
                  </div>
               </div>
            </div>

            <div class="clear"></div>


            <!-- Last Section Area Start============================================= -->
            <?php
            require_once('includes/lastsection.php');
            ?>
            <!-- Last Section Area End============================================= -->

         </div>

      </section>
      <!-- #content end -->

      <!-- Footer Section Start============================================= -->
      <?php
      require_once('includes/footer.php');
      ?>
      <!-- Footer Section Start============================================= -->
   </div>
   <!-- #wrapper end -->

   <!-- Go To Top ============================================= -->
   <div id="gotoTop" class="icon-line-arrow-up"></div>
   <!-- Scripts Section Area Start============================================= -->
   <?php
   require_once('includes/scripts.php');
   ?>
   <!-- Scripts Section Area End============================================= -->
</body>

</html>