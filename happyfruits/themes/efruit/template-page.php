<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <?php $this->load_partial('category-list') ?>
            <div class="content-container" style="background: #fff;">
                <?php if(Hash::get($obj, 'config.has_voucher_form') ||
                    Hash::get($obj, 'config.has_package_form') ||
                    Hash::get($obj, 'config.has_company_request_form')):?>
                    <div class="content-body container-fluid">
                        <div class="col-sm-9 nopadding col-xs-12 left-content">
                            <?php echo $obj['page_body'];?>
                        </div>
                        <div class="col-sm-3 nopadding col-xs-12 right-content">
                            <?php if(Hash::get($obj, 'config.has_voucher_form')) $this->load_theme_file('forms/voucher'); ?>
                            <?php if(Hash::get($obj, 'config.has_package_form')) $this->load_theme_file('forms/package'); ?>
                            <?php if(Hash::get($obj, 'config.has_company_request_form')) $this->load_theme_file('forms/company'); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="content-body container">
                        <div class="col-xs-12">
                            <?php echo $obj['page_body'];?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_theme_file('page-cooperators.php') ?>
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>