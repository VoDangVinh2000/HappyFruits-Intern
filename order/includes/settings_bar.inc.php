    <div id="live-settings" ng-class="{opened_panel:show_settings}" style="display: none;">   
       <a href="" ng-click="toggleSettings()" class="open"><span><i class="fa fa-cogs"></i></span></a>
       <div id="live-settings-admin">
    		<h5>{{__('Cài đặt')}}</h5>
    		<div class="live-settings-admin-box">
    			<div role="tablist">
    				<p role="tab" tabindex="0">
                        {{__('Hiển thị món tạm hết')}}<br />
                        <a ng-click="setSettingSoldOut(1)" ng-class="{'btn-success':settings.hideSoldOut == 1}" class="btn btn-sm">{{__('Ẩn')}}</a><a ng-click="setSettingSoldOut(0)" ng-class="{'btn-success':settings.hideSoldOut == 0}" class="btn btn-sm">{{__('Hiện')}}</a>
                    </p>
    			</div>
    		</div>
    	</div>
    </div>