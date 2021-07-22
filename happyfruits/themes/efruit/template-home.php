 <?php $this->load_theme_file('page-header.php') 
 ?>
<div class="application-body">
     <div class="y-grid">
         <div class="y-results" id="y-results">
             <div class="flat">
                 <div class="marketing">
                     <div class="container">
                         <h1 class="title efruit-vi">Các sản phẩm, dịch vụ của <?= get_setting('short_site_name') ?></h1>
                         <h1 class="title efruit-en efruitjs">Our products and services</h1>
                     </div>
                 </div>
             </div>
             <?php $this->load_partial('category-feat') ?>
             <div id="san-pham-dac-trung" class="container-fluid">
                 <?php $this->load_partial('product-listing', array('heading' => 'Sản phẩm đặc trưng trong tuần', 'showMore' => 1)) ?>
             </div>
             <?php $this->load_partial('cooperators') ?>
             <?php $this->load_partial('about-us') ?>
         </div>
     </div>
 </div>
 <?php $this->load_theme_file('page-footer.php') ?>