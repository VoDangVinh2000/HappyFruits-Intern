    <div id="language_selector" style="display: none;">
        <div class="large_screen">
            <a ng-show="settings.language == 'en'" class="btn btn-default" href="" ng-click="switchLanguage('vn')"><img class="language_flag" src="<?=SITE_URL?>images/flags/vn.png" alt="vn" width="18" height="12"/> Tiếng Việt</a>
            <a ng-show="settings.language != 'en'" class="btn btn-default" href="" ng-click="switchLanguage('en')"><img class="language_flag" src="<?=SITE_URL?>images/flags/en.png" alt="en" width="18" height="12"/> English</a>
        </div>
        <div class="small_screen">
            <ul>
                <li><a role="menuitem" tabindex="-1" href="" ng-click="switchLanguage('vn')"><img class="language_flag" src="<?=SITE_URL?>images/flags/vn.png" alt="vn" width="18" height="12"/></a></li>
                <li><a role="menuitem" tabindex="-1" href="" ng-click="switchLanguage('en')"><img class="language_flag" src="<?=SITE_URL?>images/flags/en.png" alt="en" width="18" height="12"/></a></li>
            </ul>
        </div>
    </div>