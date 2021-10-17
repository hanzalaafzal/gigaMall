<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
// Language Route
Route::post('/lang', array(
    'Middleware' => 'LanguageSwitcher',
    'uses' => 'LanguageController@index',
))->name('lang');
// For Language direct URL link
Route::get('/lang/{lang}', array(
    'Middleware' => 'LanguageSwitcher',
    'uses' => 'LanguageController@change',
))->name('langChange');
// .. End of Language Route


// Backend Routes
Auth::routes();

// default path after login
Route::get('/admin', function () {
    return redirect()->route('adminHome');
});

Route::Group(['prefix' => env('BACKEND_PATH')], function () {
    Route::Group(['middleware' => ['admin']], function () {

        Route::get('/product/create', 'OrderController@productCreate')->name('productCreate');
        Route::post('storeProduct', 'OrderController@storeProduct');
        // Route::get('/product_create', 'ProductController@create');
        // Route::post('/product/store', 'ProductController@store');

        Route::get('/orders','OrderController@adminOrders');

        Route::get('/orders/single/{orderid}','OrderController@adminOrderSingle')->name('adminOrderSingle');
        // No Permission
        Route::get('/403', function () {
            return view('errors.403');
        })->name('NoPermission');

        // Not Found
        Route::get('/404', function () {
            return view('errors.404');
        })->name('NotFound');

        // Admin Home
        Route::get('/', 'HomeController@index')->name('adminHome');
        //Search
        Route::get('/search', 'HomeController@search')->name('adminSearch');
        Route::post('/find', 'HomeController@find')->name('adminFind');

        // Webmaster
        Route::get('/webmaster', 'WebmasterSettingsController@edit')->name('webmasterSettings');
        Route::post('/webmaster', 'WebmasterSettingsController@update')->name('webmasterSettingsUpdate');

          // Shopper Approvals
        Route::get('/shopperApproval','ShopController@approveShopper');
        Route::get('/shopperApproval/{id}','ShopController@approveShopperId');

           // Withdraw Approvals
        Route::get('/withdrawRequests','ShopController@approveWithdraw');
        Route::get('/withdrawRequests/{id}','ShopController@approveWithdrawId');


        // Webmaster Banners
        Route::get('/webmaster/banners', 'WebmasterBannersController@index')->name('WebmasterBanners');
        Route::get('/webmaster/banners/create', 'WebmasterBannersController@create')->name('WebmasterBannersCreate');
        Route::post('/webmaster/banners/store', 'WebmasterBannersController@store')->name('WebmasterBannersStore');
        Route::get('/webmaster/banners/{id}/edit', 'WebmasterBannersController@edit')->name('WebmasterBannersEdit');
        Route::post('/webmaster/banners/{id}/update', 'WebmasterBannersController@update')->name('WebmasterBannersUpdate');
        Route::get('/webmaster/banners/destroy/{id}',
            'WebmasterBannersController@destroy')->name('WebmasterBannersDestroy');
        Route::post('/webmaster/banners/updateAll',
            'WebmasterBannersController@updateAll')->name('WebmasterBannersUpdateAll');

        // Webmaster Sections
        Route::get('/webmaster/sections', 'WebmasterSectionsController@index')->name('WebmasterSections');
        Route::get('/webmaster/sections/create', 'WebmasterSectionsController@create')->name('WebmasterSectionsCreate');
        Route::post('/webmaster/sections/store', 'WebmasterSectionsController@store')->name('WebmasterSectionsStore');
        Route::get('/webmaster/sections/{id}/edit', 'WebmasterSectionsController@edit')->name('WebmasterSectionsEdit');
        Route::post('/webmaster/sections/{id}/update',
            'WebmasterSectionsController@update')->name('WebmasterSectionsUpdate');

        Route::post('/webmaster/sections/{id}/seo', 'WebmasterSectionsController@seo')->name('WebmasterSectionsSEOUpdate');

        Route::get('/webmaster/sections/destroy/{id}',
            'WebmasterSectionsController@destroy')->name('WebmasterSectionsDestroy');
        Route::post('/webmaster/sections/updateAll',
            'WebmasterSectionsController@updateAll')->name('WebmasterSectionsUpdateAll');

        // Webmaster Sections :Custom Fields
        Route::get('/webmaster/{webmasterId}/fields', 'WebmasterSectionsController@webmasterFields')->name('webmasterFields');
        Route::get('/{webmasterId}/fields/create', 'WebmasterSectionsController@fieldsCreate')->name('webmasterFieldsCreate');
        Route::post('/webmaster/{webmasterId}/fields/store', 'WebmasterSectionsController@fieldsStore')->name('webmasterFieldsStore');
        Route::get('/webmaster/{webmasterId}/fields/{field_id}/edit', 'WebmasterSectionsController@fieldsEdit')->name('webmasterFieldsEdit');
        Route::post('/webmaster/{webmasterId}/fields/{field_id}/update', 'WebmasterSectionsController@fieldsUpdate')->name('webmasterFieldsUpdate');
        Route::get('/webmaster/{webmasterId}/fields/destroy/{field_id}', 'WebmasterSectionsController@fieldsDestroy')->name('webmasterFieldsDestroy');
        Route::post('/webmaster/{webmasterId}/fields/updateAll', 'WebmasterSectionsController@fieldsUpdateAll')->name('webmasterFieldsUpdateAll');

        // Settings
        Route::get('/settings', 'SettingsController@edit')->name('settings');
        Route::post('/settings', 'SettingsController@updateSiteInfo')->name('settingsUpdateSiteInfo');
        Route::post('/settings/style', 'SettingsController@updateSiteStyle')->name('settingsUpdateSiteStyle');
        Route::post('/settings/status', 'SettingsController@updateSiteStatus')->name('settingsUpdateSiteStatus');
        Route::post('/settings/social', 'SettingsController@updateSocialLinks')->name('settingsUpdateSocialLinks');
        Route::post('/settings/contacts', 'SettingsController@updateContacts')->name('settingsUpdateContacts');

        // Ad. Banners
        Route::get('/banners', 'BannersController@index')->name('Banners');
        Route::get('/banners/create/{sectionId}', 'BannersController@create')->name('BannersCreate');
        Route::post('/banners/store', 'BannersController@store')->name('BannersStore');
        Route::get('/banners/{id}/edit', 'BannersController@edit')->name('BannersEdit');
        Route::post('/banners/{id}/update', 'BannersController@update')->name('BannersUpdate');
        Route::get('/banners/destroy/{id}', 'BannersController@destroy')->name('BannersDestroy');
        Route::post('/banners/updateAll', 'BannersController@updateAll')->name('BannersUpdateAll');

        // Sections
        Route::get('/{webmasterId}/sections', 'SectionsController@index')->name('sections');
        Route::get('/{webmasterId}/sections/create', 'SectionsController@create')->name('sectionsCreate');
        Route::post('/{webmasterId}/sections/store', 'SectionsController@store')->name('sectionsStore');
        Route::get('/{webmasterId}/sections/{id}/edit', 'SectionsController@edit')->name('sectionsEdit');
        Route::post('/{webmasterId}/sections/{id}/update', 'SectionsController@update')->name('sectionsUpdate');
        Route::post('/{webmasterId}/sections/{id}/seo', 'SectionsController@seo')->name('sectionsSEOUpdate');
        Route::get('/{webmasterId}/sections/destroy/{id}', 'SectionsController@destroy')->name('sectionsDestroy');
        Route::post('/{webmasterId}/sections/updateAll', 'SectionsController@updateAll')->name('sectionsUpdateAll');

        // Topics
        Route::get('/{webmasterId}/topics', 'TopicsController@index')->name('topics');
        Route::get('/{webmasterId}/topics/create', 'TopicsController@create')->name('topicsCreate');
        Route::post('/{webmasterId}/topics/store', 'TopicsController@store')->name('topicsStore');
        Route::get('/{webmasterId}/topics/{id}/edit', 'TopicsController@edit')->name('topicsEdit');
        Route::post('/{webmasterId}/topics/{id}/update', 'TopicsController@update')->name('topicsUpdate');
        Route::get('/{webmasterId}/topics/destroy/{id}', 'TopicsController@destroy')->name('topicsDestroy');
        Route::post('/{webmasterId}/topics/updateAll', 'TopicsController@updateAll')->name('topicsUpdateAll');
        // Topics :SEO
        Route::post('/{webmasterId}/topics/{id}/seo', 'TopicsController@seo')->name('topicsSEOUpdate');
        // Topics :Photos
        Route::post('/{webmasterId}/topics/{id}/photos', 'TopicsController@photos')->name('topicsPhotosEdit');
        Route::get('/{webmasterId}/topics/{id}/photos/{photo_id}/destroy',
            'TopicsController@photosDestroy')->name('topicsPhotosDestroy');
        Route::post('/{webmasterId}/topics/{id}/photos/updateAll',
            'TopicsController@photosUpdateAll')->name('topicsPhotosUpdateAll');

        // Topics :Files
        Route::get('/{webmasterId}/topics/{id}/files', 'TopicsController@topicsFiles')->name('topicsFiles');
        Route::get('/{webmasterId}/topics/{id}/files/create',
            'TopicsController@filesCreate')->name('topicsFilesCreate');
        Route::post('/{webmasterId}/topics/{id}/files/store',
            'TopicsController@filesStore')->name('topicsFilesStore');
        Route::get('/{webmasterId}/topics/{id}/files/{file_id}/edit',
            'TopicsController@filesEdit')->name('topicsFilesEdit');
        Route::post('/{webmasterId}/topics/{id}/files/{file_id}/update',
            'TopicsController@filesUpdate')->name('topicsFilesUpdate');
        Route::get('/{webmasterId}/topics/{id}/files/destroy/{file_id}',
            'TopicsController@filesDestroy')->name('topicsFilesDestroy');
        Route::post('/{webmasterId}/topics/{id}/files/updateAll',
            'TopicsController@filesUpdateAll')->name('topicsFilesUpdateAll');


        // Topics :Related
        Route::get('/{webmasterId}/topics/{id}/related', 'TopicsController@topicsRelated')->name('topicsRelated');
        Route::get('/relatedLoad/{id}', 'TopicsController@topicsRelatedLoad')->name('topicsRelatedLoad');
        Route::get('/{webmasterId}/topics/{id}/related/create',
            'TopicsController@relatedCreate')->name('topicsRelatedCreate');
        Route::post('/{webmasterId}/topics/{id}/related/store',
            'TopicsController@relatedStore')->name('topicsRelatedStore');
        Route::get('/{webmasterId}/topics/{id}/related/destroy/{related_id}',
            'TopicsController@relatedDestroy')->name('topicsRelatedDestroy');
        Route::post('/{webmasterId}/topics/{id}/related/updateAll',
            'TopicsController@relatedUpdateAll')->name('topicsRelatedUpdateAll');
        // Topics :Comments
        Route::get('/{webmasterId}/topics/{id}/comments', 'TopicsController@topicsComments')->name('topicsComments');
        Route::get('/{webmasterId}/topics/{id}/comments/create',
            'TopicsController@commentsCreate')->name('topicsCommentsCreate');
        Route::post('/{webmasterId}/topics/{id}/comments/store',
            'TopicsController@commentsStore')->name('topicsCommentsStore');
        Route::get('/{webmasterId}/topics/{id}/comments/{comment_id}/edit',
            'TopicsController@commentsEdit')->name('topicsCommentsEdit');
        Route::post('/{webmasterId}/topics/{id}/comments/{comment_id}/update',
            'TopicsController@commentsUpdate')->name('topicsCommentsUpdate');
        Route::get('/{webmasterId}/topics/{id}/comments/destroy/{comment_id}',
            'TopicsController@commentsDestroy')->name('topicsCommentsDestroy');
        Route::post('/{webmasterId}/topics/{id}/comments/updateAll',
            'TopicsController@commentsUpdateAll')->name('topicsCommentsUpdateAll');
        // Topics :Maps
        Route::get('/{webmasterId}/topics/{id}/maps', 'TopicsController@topicsMaps')->name('topicsMaps');
        Route::get('/{webmasterId}/topics/{id}/maps/create', 'TopicsController@mapsCreate')->name('topicsMapsCreate');
        Route::post('/{webmasterId}/topics/{id}/maps/store', 'TopicsController@mapsStore')->name('topicsMapsStore');
        Route::get('/{webmasterId}/topics/{id}/maps/{map_id}/edit', 'TopicsController@mapsEdit')->name('topicsMapsEdit');
        Route::post('/{webmasterId}/topics/{id}/maps/{map_id}/update',
            'TopicsController@mapsUpdate')->name('topicsMapsUpdate');
        Route::get('/{webmasterId}/topics/{id}/maps/destroy/{map_id}',
            'TopicsController@mapsDestroy')->name('topicsMapsDestroy');
        Route::post('/{webmasterId}/topics/{id}/maps/updateAll',
            'TopicsController@mapsUpdateAll')->name('topicsMapsUpdateAll');

        // Contacts Groups
        Route::post('/contacts/storeGroup', 'ContactsController@storeGroup')->name('contactsStoreGroup');
        Route::get('/contacts/{id}/editGroup', 'ContactsController@editGroup')->name('contactsEditGroup');
        Route::post('/contacts/{id}/updateGroup', 'ContactsController@updateGroup')->name('contactsUpdateGroup');
        Route::get('/contacts/destroyGroup/{id}', 'ContactsController@destroyGroup')->name('contactsDestroyGroup');
        // Contacts
        Route::get('/contacts/{group_id?}', 'ContactsController@index')->name('contacts');
        Route::post('/contacts/store', 'ContactsController@store')->name('contactsStore');
        Route::post('/contacts/search', 'ContactsController@search')->name('contactsSearch');
        Route::get('/contacts/{id}/edit', 'ContactsController@edit')->name('contactsEdit');
        Route::post('/contacts/{id}/update', 'ContactsController@update')->name('contactsUpdate');
        Route::get('/contacts/destroy/{id}', 'ContactsController@destroy')->name('contactsDestroy');
        Route::post('/contacts/updateAll', 'ContactsController@updateAll')->name('contactsUpdateAll');

        // WebMails Groups
        Route::post('/webmails/storeGroup', 'WebmailsController@storeGroup')->name('webmailsStoreGroup');
        Route::get('/webmails/{id}/editGroup', 'WebmailsController@editGroup')->name('webmailsEditGroup');
        Route::post('/webmails/{id}/updateGroup', 'WebmailsController@updateGroup')->name('webmailsUpdateGroup');
        Route::get('/webmails/destroyGroup/{id}', 'WebmailsController@destroyGroup')->name('webmailsDestroyGroup');
        // WebMails
        Route::post('/webmails/store', 'WebmailsController@store')->name('webmailsStore');
        Route::post('/webmails/search', 'WebmailsController@search')->name('webmailsSearch');
        Route::get('/webmails/{id}/edit', 'WebmailsController@edit')->name('webmailsEdit');
        Route::get('/webmails/{group_id?}/{wid?}/{stat?}/{contact_email?}', 'WebmailsController@index')->name('webmails');
        Route::post('/webmails/{id}/update', 'WebmailsController@update')->name('webmailsUpdate');
        Route::get('/webmails/destroy/{id}', 'WebmailsController@destroy')->name('webmailsDestroy');
        Route::post('/webmails/updateAll', 'WebmailsController@updateAll')->name('webmailsUpdateAll');

        // Calendar
        Route::get('/calendar', 'EventsController@index')->name('calendar');
        Route::get('/calendar/create', 'EventsController@create')->name('calendarCreate');
        Route::post('/calendar/store', 'EventsController@store')->name('calendarStore');
        Route::get('/calendar/{id}/edit', 'EventsController@edit')->name('calendarEdit');
        Route::post('/calendar/{id}/update', 'EventsController@update')->name('calendarUpdate');
        Route::get('/calendar/destroy/{id}', 'EventsController@destroy')->name('calendarDestroy');
        Route::get('/calendar/updateAll', 'EventsController@updateAll')->name('calendarUpdateAll');
        Route::post('/calendar/{id}/extend', 'EventsController@extend')->name('calendarExtend');

        // Analytics
        Route::get('/ip/{ip_code?}', 'AnalyticsController@ip')->name('visitorsIP');
        Route::post('/ip/search', 'AnalyticsController@search')->name('visitorsSearch');
        Route::post('/analytics/{stat}', 'AnalyticsController@filter')->name('analyticsFilter');
        Route::get('/analytics/{stat?}', 'AnalyticsController@index')->name('analytics');
        Route::get('/visitors', 'AnalyticsController@visitors')->name('visitors');

        // Users & Permissions
        Route::get('/users', 'UsersController@index')->name('users');
        Route::get('/users/create/', 'UsersController@create')->name('usersCreate');
        Route::post('/users/store', 'UsersController@store')->name('usersStore');
        Route::get('/users/{id}/edit', 'UsersController@edit')->name('usersEdit');
        Route::post('/users/{id}/update', 'UsersController@update')->name('usersUpdate');
        Route::get('/users/destroy/{id}', 'UsersController@destroy')->name('usersDestroy');
        Route::post('/users/updateAll', 'UsersController@updateAll')->name('usersUpdateAll');

        Route::get('/users/permissions/create/', 'UsersController@permissions_create')->name('permissionsCreate');
        Route::post('/users/permissions/store', 'UsersController@permissions_store')->name('permissionsStore');
        Route::get('/users/permissions/{id}/edit', 'UsersController@permissions_edit')->name('permissionsEdit');
        Route::post('/users/permissions/{id}/update', 'UsersController@permissions_update')->name('permissionsUpdate');
        Route::get('/users/permissions/destroy/{id}', 'UsersController@permissions_destroy')->name('permissionsDestroy');


        // Menus
        Route::post('/menus/store/parent', 'MenusController@storeMenu')->name('parentMenusStore');
        Route::get('/menus/parent/{id}/edit', 'MenusController@editMenu')->name('parentMenusEdit');
        Route::post('/menus/{id}/update/{ParentMenuId}', 'MenusController@updateMenu')->name('parentMenusUpdate');
        Route::get('/menus/parent/destroy/{id}', 'MenusController@destroyMenu')->name('parentMenusDestroy');

        Route::get('/menus/{ParentMenuId?}', 'MenusController@index')->name('menus');
        Route::get('/menus/create/{ParentMenuId?}', 'MenusController@create')->name('menusCreate');
        Route::post('/menus/store/{ParentMenuId?}', 'MenusController@store')->name('menusStore');
        Route::get('/menus/{id}/edit/{ParentMenuId?}', 'MenusController@edit')->name('menusEdit');
        Route::post('/menus/{id}/update', 'MenusController@update')->name('menusUpdate');
        Route::get('/menus/destroy/{id}', 'MenusController@destroy')->name('menusDestroy');
        Route::post('/menus/updateAll', 'MenusController@updateAll')->name('menusUpdateAll');

        //Categories
        Route::get('/categories', 'CategoriesController@create')->name('categories');
        Route::post('/categories/store', 'CategoriesController@store')->name('categoriesStore');
        Route::get('/categories/active/{slug}', 'CategoriesController@active')->name('categoriesActive');
        Route::get('/categories/disable/{slug}', 'CategoriesController@disable')->name('categoriesDisable');
        Route::get('/categories/delete/{slug}', 'CategoriesController@delete')->name('categoriesDelete');
        Route::get('/categories/edit/{slug}', 'CategoriesController@edit')->name('categoriesEdit');
        Route::post('/categories/update', 'CategoriesController@update')->name('categoriesUpdate');

        //SubCategories
        Route::get('/sub-categories', 'SubCategoriesController@create')->name('SubCategories');
        Route::post('/sub-categories/store', 'SubCategoriesController@store')->name('SubCategoriesStore');
        Route::get('/sub-categories/active/{slug}', 'SubCategoriesController@active')->name('SubCategoriesActive');
        Route::get('/sub-categories/disable/{slug}', 'SubCategoriesController@disable')->name('SubCategoriesDisable');
        Route::get('/sub-categories/delete/{slug}', 'SubCategoriesController@delete')->name('SubCategoriesDelete');
        Route::get('/sub-categories/edit/{slug}', 'SubCategoriesController@edit')->name('SubCategoriesEdit');
        Route::post('/sub-categories/update', 'SubCategoriesController@update')->name('SubCategoriesUpdate');

        //Discounts-Coupons
        Route::get('/coupons', 'CouponsController@coupons')->name('coupons');
        Route::post('/coupons/store', 'CouponsController@store')->name('couponsStore');
        Route::get('/coupons/disable/{id}', 'CouponsController@disableCoupon')->name('couponDisable');
        Route::get('/coupon/active/{id}', 'CouponsController@activeCoupon')->name('couponActive');
        Route::get('/coupon/edit/{id}', 'CouponsController@editCoupon')->name('couponEdit');
        Route::get('/coupon/delete/{id}', 'CouponsController@deleteCoupon')->name('couponDelete');
        Route::post('/coupon/update', 'CouponsController@updateCoupon')->name('couponsUpdate');


        //Discounts-Deals
        Route::get('/deals', 'CouponsController@deals')->name('deals');
        Route::post('/deals/store', 'CouponsController@storeDeal')->name('dealsStore');
        Route::get('/deals/disable/{id}', 'CouponsController@disableDeal')->name('dealDisable');
        Route::get('/deal/active/{id}', 'CouponsController@activeDeal')->name('dealActive');
        Route::get('/deal/edit/{id}', 'CouponsController@editDeal')->name('dealEdit');
        Route::get('/deal/delete/{id}', 'CouponsController@deleteDeal')->name('dealDelete');
        Route::post('/deal/update', 'CouponsController@updateDeal')->name('dealsUpdate');


        //wallet admin section

         Route::get('/wallets', 'WalletController@wallets')->name('wallets');
         Route::get('/wallets/debit/{id}', 'WalletController@walletDebitShow')->name('walletDebitShow');
         Route::get('/wallets/credit/{id}', 'WalletController@walletCreditShow')->name('walletCreditShow');
         Route::get('/wallets/edit/{id}', 'WalletController@walletEdit')->name('walletEdit');
         Route::post('/wallet/deduct', 'WalletController@deductFromWallet')->name('deductFromWallet');
         Route::post('/wallet/add', 'WalletController@addFromWallet')->name('addFromWallet');
         Route::get('/wallets/history/{id}', 'WalletController@walletHistoryShow')->name('walletHistoryShow');
         Route::post('/wallets/history/filter', 'WalletController@historyFilters')->name('historyFilters');


         // Packages
        Route::get('/shop-packages', 'PackageController@index')->name('shopPackages');
        Route::post('/shop-packages/store', 'PackageController@store')->name('shopPackagesStore');
        Route::get('/shop-packages/edit/{id}', 'PackageController@edit')->name('shopPackagesEdit');
        Route::post('/shop-packages/update', 'PackageController@update')->name('shopPackagesUpdate');
        Route::get('/shop-packages/active/{id}', 'PackageController@active')->name('shopPackagesActive');
        Route::get('/shop-packages/disable/{id}', 'PackageController@disable')->name('shopPackagesDisable');

        //Product Type
        Route::get('/product-types', 'ProductTypeController@index')->name('productType');
        Route::post('/product-types/store', 'ProductTypeController@store')->name('productTypeStore');
        Route::get('/product-types/edit/{id}', 'ProductTypeController@edit')->name('productTypeEdit');
        Route::get('/product-types/delete/{id}', 'ProductTypeController@delete')->name('productTypeDelete');
        Route::post('/product-types/update', 'ProductTypeController@update')->name('productTypeUpdate');

        // Approvals Shop
        Route::get('/shop/approval/list', 'ShopController@approveList')->name('shopApprovalList');
        Route::get('/shop/approve/{id}', 'ShopController@approve')->name('shopApprove');

        //Affiliator Approvals
        Route::get('/affiliator/approval/list','ShopController@getApprovalListAffialiators')->name('getApprovalListAffialiators');
        Route::get('/affiliator/approve/{id}/{newStatus}','ShopController@approveAffiliator')->name('approveAffiliator');

        // Edit Shop
        Route::get('/shop/edit/{id}', 'ShopController@editShopAdmin')->name('editShopAdmin');
        Route::post('/shop/update/', 'ShopController@updateShopAdmin')->name('updateShopAdmin');

        // Details Shop
        Route::get('search/shops/{slug}', 'ShopController@searchShopsSlug')->name('searchShopsSlug');
        Route::post('search/shops', 'ShopController@searchShops')->name('searchShops');


        Route::get('/shops/all', 'ShopController@shopsAll')->name('shopsAll');
        Route::get('/shops/active', 'ShopController@shopsActive')->name('shopsActive');
        Route::get('/shops/pending', 'ShopController@shopsPending')->name('shopsPending');
        Route::get('/shops/disable', 'ShopController@shopsDisable')->name('shopsDisable');
        Route::get('/shops/renewal', 'ShopController@shopsRenewal')->name('shopsRenewal');
        Route::get('/shops/deleted', 'ShopController@shopsDeleted')->name('shopsDeleted');

        // In/Active/Delete Shop
        Route::get('/shop/disable/{id}', 'ShopController@disable')->name('shopDisable');
        Route::get('/shop/active/{id}', 'ShopController@active')->name('shopActive');
        Route::get('/shop/delete/{id}', 'ShopController@delete')->name('shopDeleted');

        // In/Active/Delete Product
        Route::get('/product/disable/{id}', 'ProductController@disable')->name('productDisable');
        Route::get('/product/active/{id}', 'ProductController@active')->name('productActive');
        Route::get('/product/delete/{id}', 'ProductController@delete')->name('productDeleted');



        // Product Approvals
        Route::get('/product/approval/list', 'ProductController@approveList')->name('prodcutApprovalList');
        Route::get('/product/approve/{id}', 'ProductController@approve')->name('productApprove');
        Route::get('/product/edit/approval/list', 'ProductController@editApproveList')->name('EditprodcutApprovalList');
        Route::get('/product/edit/approve/{id}', 'ProductController@editApprove')->name('EditprodcutApprove');
        Route::get('/product/edit/disapprove/{id}', 'ProductController@editDisapprove')->name('EditprodcutDisapprove');
        Route::get('/product/delivered/approve', 'ProductController@approveDeliveredProducts')->name('approveDeliveredProducts');
        Route::get('/product/active/delivered/approve', 'ProductController@productsActiveDelivered')->name('productsActiveDelivered');
        Route::get('/product/active/completed/approved', 'ProductController@productsActiveCompleted')->name('productsActiveCompleted');
        Route::get('/product/deactive/rejected', 'ProductController@productsDeactiveRejected')->name('productsDeactiveRejected');
        Route::get('/product/deactive/reject/{id}', 'ProductController@productsReject')->name('productsReject');
        Route::get('/product/active/Complete/{id}', 'ProductController@productsComplete')->name('productsComplete');
        Route::get('/product/active/delivered/{id}', 'ProductController@backToDelivered')->name('backToDelivered');
        Route::get('product/order/edit/{id}', 'ProductController@editOrderProductAdmin')->name('editOrderProductAdmin');
        Route::post('product/order/edit/approved', 'ProductController@editApprovedProductAdmin')->name('editApprovedProductAdmin');

        // Edit Product
        Route::get('/product/edit/{id}', 'ProductController@editProductAdmin')->name('editProductAdmin');
        Route::post('/product/update', 'ProductController@updateProductAdmin')->name('updateProductAdmin');

        // Details products
        Route::get('search/products/{slug}', 'ProductController@searchProductsSlug')->name('searchProductsSlug');
        Route::post('search/products', 'ProductController@searchProducts')->name('searchProducts');



        Route::get('/products/all', 'ProductController@productsAll')->name('productsAll');
        Route::get('/products/active', 'ProductController@productsActive')->name('productsActive');
        Route::get('/products/pending', 'ProductController@productsPending')->name('productsPending');
        Route::get('/products/disable', 'ProductController@productsDisable')->name('productsDisable');
        Route::get('/products/renewal', 'ProductController@productsRenewal')->name('productsRenewal');
        Route::get('/products/deleted', 'ProductController@productsDeleted')->name('productsDeleted');

        // Featured Products
        Route::get('/products/featured/create/{id}', 'ProductController@productsFeaturedCreate')->name('productsFeaturedCreate');
        Route::get('/products/unfeatured/create/{id}', 'ProductController@productsUnFeatured')->name('productsUnFeatured');

        // Featured Shops
        Route::get('/shops/featured/create/{id}', 'ShopController@shopsFeaturedCreate')->name('shopsFeaturedCreate');
        Route::get('/shops/unfeatured/create/{id}', 'ShopController@shopsUnFeatured')->name('shopsUnFeatured');

        //Contact Us
        Route::get('/contact-us/messages', 'ContactUsController@contactUsMessages')->name('contactUsMessages');

    });
});

// .. End of Backend Routes

// RESTful API routes
Route::Group(['prefix' => '/api/v1'], function () {

    Route::get('/', 'APIsController@api');
    // general
    Route::get('/website/status', 'APIsController@website_status');
    Route::get('/website/info/{lang?}', 'APIsController@website_info');
    Route::get('/website/contacts/{lang?}', 'APIsController@website_contacts');
    Route::get('/website/style/{lang?}', 'APIsController@website_style');
    Route::get('/website/social', 'APIsController@website_social');
    Route::get('/website/settings', 'APIsController@website_settings');
    Route::get('/menu/{menu_id}/{lang?}', 'APIsController@menu');
    Route::get('/banners/{group_id}/{lang?}', 'APIsController@banners');
    // section & topics
    Route::get('/section/{section_id}/{lang?}', 'APIsController@section');
    Route::get('/categories/{section_id}/{lang?}', 'APIsController@categories');
    Route::get('/topics/{section_id}/page/{page_number?}/count/{topics_count?}/{lang?}', 'APIsController@topics');
    // topic sub details
    Route::get('/topic/fields/{topic_id}/{lang?}', 'APIsController@topic_fields');
    Route::get('/topic/photos/{topic_id}/{lang?}', 'APIsController@topic_photos');
    Route::get('/topic/photo/{photo_id}/{lang?}', 'APIsController@topic_photo');
    Route::get('/topic/maps/{topic_id}/{lang?}', 'APIsController@topic_maps');
    Route::get('/topic/map/{map_id}/{lang?}', 'APIsController@topic_map');
    Route::get('/topic/files/{topic_id}/{lang?}', 'APIsController@topic_files');
    Route::get('/topic/file/{file_id}/{lang?}', 'APIsController@topic_file');
    Route::get('/topic/comments/{topic_id}/{lang?}', 'APIsController@topic_comments');
    Route::get('/topic/comment/{comment_id}/{lang?}', 'APIsController@topic_comment');
    Route::get('/topic/related/{topic_id}/{lang?}', 'APIsController@topic_related');
    // topic page
    Route::get('/topic/{topic_id}/{lang?}', 'APIsController@topic');
    // user topics
    Route::get('/user/{user_id}/topics/page/{page_number?}/count/{topics_count?}/{lang?}', 'APIsController@user_topics');
    // Forms Submit
    Route::post('/subscribe', 'APIsController@subscribeSubmit');
    Route::post('/comment', 'APIsController@commentSubmit');
    Route::post('/order', 'APIsController@orderSubmit');
    Route::post('/contact', 'APIsController@ContactPageSubmit');
});
// .. End of RESTful API routes


/**************** Auth Routes ********************/
Route::Group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');
    // Affiliate Link Data
    Route::get('/client_affiliate', 'UsersController@client_affiliate')->name('client_affiliate');
    Route::get('/client_withdraw_request', 'UsersController@client_withdraw_request')->name('client_withdraw_request');



    //Update Password
    //Reset Password
    Route::get('reset/password', 'UserDetailsController@clientResetPassword')->name('ResetPassword');

    Route::post('reset/password/post', 'UserDetailsController@ResetPasswordUpdate')->name('ResetPasswordUpdate');

    //User Details
    Route::post('/user-details', 'UserDetailsController@store')->name('storeUserDetails');
    Route::post('/storeShopperDetails', 'UserDetailsController@storeShopper');

    //Favourites
    Route::get('/favourite/{product_slug}', 'FavouriteController@create')->name('favouriteProduct');
    Route::get('/unfavourite/{id}', 'FavouriteController@destroy')->name('unFavouriteProduct');
    Route::get('/chat/{user_name}', 'ChatController@chat')->name('chat');
    Route::get('/inbox', 'ChatController@inbox')->name('inbox');
    //video route
    Route::get('/chat-update/{dvid}/{roomid}', 'ConferenceController@updateChat')->name('updateChat');

    Route::get('video/conferencing', 'ConferenceController@videoConference')->name('videoConference');
    Route::get('audio/conferencing', 'ConferenceController@audioConference')->name('audioConference');
    Route::get('broadcast/video', 'ConferenceController@videoBroadcast')->name('videoBroadcast');
});

// Route::get('reset/password', 'UserDetailsController@clientResetPassword');
/**************** Client Routes ********************/
Route::Group(['middleware' => ['client']], function () {
    //Reset Password
    Route::get('client/reset/password', 'UserDetailsController@clientResetPassword')->name('clientResetPassword');

    // Order
    Route::get('/recharge_e_wallet','OrderController@recharge_e_wallet')->name('hellll');
    Route::post('/recharge_e_wallet','OrderController@post_recharge_e_wallet')->name('postRecharge');

    //Client Details
    Route::post('/address-store', 'UserDetailsController@storeAddress')->name('storeAddress');
    Route::get('/address-delete/{id}', 'UserDetailsController@deleteAddress')->name('deleteAddress');
    Route::post('/address/update', 'UserDetailsController@updateAddress')->name('updateAddress');

    // Cart
    Route::get('/my-cart', 'CartController@myCart')->name('myCart');
    Route::get('/add-cart/{product_slug}', 'CartController@create')->name('addCart');
    Route::get('/cart-update/{id}/{quantity}', 'CartController@update')->name('updateCart');
    Route::get('/cart-remove/{id}', 'CartController@destroy')->name('removeCart');
    Route::get('/checkout', 'CartController@checkout')->name('checkout');



    Route::get('withdraw_amount','OrderController@withdraw_amount');
    Route::post('withdraw_amount','OrderController@post_withdraw_amount');



    Route::post('/cash_on_delivery/{subtotal}/{shipping}','OrderController@cash_on_delivery')->name('cash_on_delivery');
    Route::get('/bank_payment/{subtotal}/{shipping}/{shipping_ad}/{billing_ad}','OrderController@storeBank')->name('bank_payment');
    Route::post('bank_payment','OrderController@paymentPost')->name('paymentBank');
    Route::post('/store-order', 'OrderController@store')->name('storeOrder');

    Route::get('/order/cancel/{OrderId}','OrderController@cancelOrder')->name('cancelOrder');

    Route::get('client/order/active', 'OrderController@clientOrdersActive')->name('clientOrdersActive');
    Route::get('client/order/all', 'OrderController@clientOrdersAll')->name('clientOrdersAll');
    Route::get('client/order/completed', 'OrderController@clientOrdersCompleted')->name('clientOrdersCompleted');
    Route::get('client/order/canceled', 'OrderController@clientOrdersCanceled')->name('clientOrdersCanceled');
    Route::get('client/order/view/{id}', 'OrderController@clientOrderView')->name('clientOrderView');
    Route::get('client/order/complete/{id}', 'OrderController@clientMarkDelivered')->name('clientMarkDelivered');
    Route::get('downloadInvoice/{id}','OrderController@downloadInvoice');

    //Reviews
    Route::post('/client/reviews/post', 'ReviewController@clientReviewsPost')->name('clientReviewsPost');
    Route::get('/client/reviews/all', 'ReviewController@clientReviewsAll')->name('clientReviewsAll');
    Route::get('/client/reviews/pending', 'ReviewController@clientReviewsPending')->name('clientReviewsPending');

    //Client Favourites
    Route::get('/my-favourites', 'FavouriteController@myFavourites')->name('myFavourites');

    // Get Addresses
    Route::get('/get-address/{id}', 'UserDetailsController@getAddress')->name('getAddress');

    //Favourites
    Route::get('/favourite/{product_slug}', 'FavouriteController@create')->name('favouriteProduct');
    Route::get('/unfavourite/{id}', 'FavouriteController@destroy')->name('unFavouriteProduct');

    //Sales Statements
    Route::get('client/purchase-statements', 'OrderController@purchaseStatements')->name('clientPurchaseStatements');

   //coupon Redeem section
    Route::post('/coupon/redeem', 'CouponsController@couponsRedeem')->name('couponsRedeem');
});

/**************** Vendor Routes ********************/
Route::Group(['middleware' => ['vendor']], function () {

  // Order
  Route::get('/recharge_e_wallet','OrderController@recharge_e_wallet')->name('hellll');
  Route::post('/recharge_e_wallet','OrderController@post_recharge_e_wallet')->name('postRecharge');

    Route::get('shop/vendor/add-bonus/', 'UserDetailsController@addBonus')->name('vendorAddBonus');

    Route::post('/cash_on_delivery/{subtotal}/{shipping}','OrderController@cash_on_delivery')->name('cash_on_delivery');
    Route::get('/bank_payment/{subtotal}/{shipping}/{shipping_ad}/{billing_ad}','OrderController@storeBank')->name('bank_payment');
    Route::post('bank_payment','OrderController@paymentPost')->name('paymentBank');
    Route::post('/store-order', 'OrderController@store')->name('storeOrder');

    Route::post('/address-store', 'UserDetailsController@storeAddress')->name('storeAddress');
    Route::get('/address-delete/{id}', 'UserDetailsController@deleteAddress')->name('deleteAddress');
    Route::post('/address/update', 'UserDetailsController@updateAddress')->name('updateAddress');

    Route::get('/order/cancel/{OrderId}','OrderController@cancelOrder')->name('cancelOrder');

    Route::get('affiliator/order/active', 'OrderController@clientOrdersActive')->name('clientOrdersActive');
    Route::get('affiliator/order/all', 'OrderController@clientOrdersAll')->name('clientOrdersAll');
    Route::get('affiliator/order/completed', 'OrderController@clientOrdersCompleted')->name('clientOrdersCompleted');
    Route::get('affiliator/order/canceled', 'OrderController@clientOrdersCanceled')->name('clientOrdersCanceled');
    Route::get('affiliator/order/view/{id}', 'OrderController@clientOrderView')->name('clientOrderView');
    Route::get('affiliator/order/complete/{id}', 'OrderController@clientMarkDelivered')->name('clientMarkDelivered');
    Route::get('downloadInvoice/{id}','OrderController@downloadInvoice');

    Route::get('/add-cart/{product_slug}', 'CartController@create')->name('addCart');
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
    Route::get('/my-cart', 'CartController@myCart')->name('myCart');
    Route::get('/add-cart/{product_slug}', 'CartController@create')->name('addCart');
    Route::get('/cart-update/{id}/{quantity}', 'CartController@update')->name('updateCart');
    Route::get('/cart-remove/{id}', 'CartController@destroy')->name('removeCart');

    //Reset Password
    Route::get('vendor/reset/password', 'UserDetailsController@vendorResetPassword')->name('vendorResetPassword');

    // Package
    Route::get('my-packages/buy', 'PaymentsController@buy')->name('buyPackage');
    Route::post('/choose-package','PaymentsController@choosePackage')->name('ChoosePackage');
    Route::get('/my-packages/', 'PaymentsController@myPackages')->name('myPackages');
    Route::post('/master-card/payment/', 'PaymentsController@authorizeNet')->name('masterCardAuthorizeNet');

    // Shops
    Route::get('/shop/create', 'ShopController@create')->name('shopCreate');
    Route::post('/shop/store', 'ShopController@store')->name('shopStore');
    Route::get('/shop/edit/{slug}', 'ShopController@edit')->name('shopEdit');
    Route::get('/shop/delete/{slug}', 'ShopController@delete')->name('shopDelete');
    Route::post('/shop/update', 'ShopController@update')->name('shopUpdate');
    Route::get('/my-shops/all', 'ShopController@myShops')->name('myShops');
    Route::get('/my-shops/active/', 'ShopController@myShopsActive')->name('myShopsActive');
    Route::get('/my-shops/pending', 'ShopController@myShopsPending')->name('myShopsPending');
    Route::get('/my-shops/disable', 'ShopController@myShopsDisable')->name('myShopsDisable');
    Route::get('/my-shops/renewal', 'ShopController@myShopsRenewal')->name('myShopsRenewal');
    Route::get('/my-shops/{slug}', 'ShopController@myShopsView')->name('myShopsView');

    // Products
    Route::get('/product/create', 'ProductController@create')->name('productCreate');
    Route::post('/product/store', 'ProductController@store')->name('productStore');
    Route::get('/product/edit/{slug}', 'ProductController@edit')->name('productEdit');
    Route::get('/product/gallery/edit/{slug}', 'ProductController@editGallery')->name('productGalleryEdit');
    Route::post('/product/gallery/delete', 'ProductController@deleteGallery')->name('productGalleryDelete');
    Route::post('/product/gallery/update', 'ProductController@updateGallery')->name('productGalleryUpdate');
    Route::post('/product/update', 'ProductController@update')->name('productUpdate');
    Route::get('/my-products/all', 'ProductController@myProducts')->name('myProducts');
    Route::get('/my-products/active/', 'ProductController@myProductsActive')->name('myProductsActive');
    Route::get('/my-products/pending', 'ProductController@myProductsPending')->name('myProductsPending');
    Route::get('/my-products/disable', 'ProductController@myProductsDisable')->name('myProductsDisable');
    Route::get('/my-products/renewal', 'ProductController@myProductsRenewal')->name('myProductsRenewal');
    Route::get('/my-products/{slug}', 'ProductController@myProductsView')->name('myProductsView');

    // Orders
    Route::get('vendor/order/view/{id}', 'OrderController@vendorOrderView')->name('vendorOrderView');
    Route::get('vendor/order/all', 'OrderController@vendorOrdersAll')->name('vendorOrdersAll');
    Route::get('vendor/order/pending', 'OrderController@vendorOrdersPending')->name('vendorOrdersPending');
    Route::get('vendor/order/delivered', 'OrderController@vendorOrdersDelivered')->name('vendorOrdersDelivered');
    Route::get('vendor/order/completed', 'OrderController@vendorOrdersCompleted')->name('vendorOrdersCompleted');
    Route::get('vendor/order/rejected', 'OrderController@vendorOrdersRejected')->name('vendorOrdersRejected');

    // Withdraw
    Route::get('withdraw_amount','OrderController@withdraw_amount');
    Route::post('withdraw_amount','OrderController@post_withdraw_amount');



    //video

    // Route::get('vendor/video/conferencing', 'ConferenceController@videoConference')->name('videoConference');

    //Order Actions
    Route::post('vendor/order/accept', 'OrderController@vendorOrderAccept')->name('vendorOrderAccept');
    Route::get('vendor/order/reject/{id}', 'OrderController@vendorOrderReject')->name('vendorOrderReject');
    Route::get('vendor/order/deliver/{id}', 'OrderController@vendorOrderDeliver')->name('vendorOrderDeliver');
    Route::get('vendor/order/shipped/{id}', 'OrderController@vendorOrderShipped')->name('vendorOrderShipped');
    //Withdrawal Actions
    Route::get('vendor/withdrawal', 'PaymentsController@withdrawal')->name('vendorWithdrawal');
    Route::post('vendor/withdrawal/post', 'PaymentsController@withdrawalPost')->name('vendorWithdrawalPost');

    //Sales Statements
    Route::get('vendor/sales-statements', 'OrderController@salesStatements')->name('vendorSalesStatements');

});

///////////////////// Non Auth /////////////////////

// Cron Jobs
Route::get('cron/add-bonus/', 'CronJobsController@addBonus');
Route::get('cron/shops','CronJobsController@cronShopRefCode');
Route::get('cron/shops/delete','CronJobsController@deleteShops');
Route::get('cron/product/delete','CronJobsController@deleteProducts');
Route::get('cron/shops/renewal','CronJobsController@shopsRenewal');

//Password Reset
Route::post('/password-reset', 'Auth\ForgotPasswordController@sendResetPasswordLink')->name('sendResetPasswordLink');
Route::get('/reset/password/{token}', 'Auth\ForgotPasswordController@resetPasswordToken')->name('resetPasswordToken');
Route::post('/reset/password', 'Auth\ForgotPasswordController@resetPassword')->name('resetPassword');

//General Route
Route::get('/get-states/{id}', 'GeneralController@getStates')->name('getStates');
Route::get('/get-cities/{id}', 'GeneralController@getCities')->name('getCities');
Route::get('/get-categories/{id}', 'GeneralController@getCategories')->name('getCategories');
Route::get('/get-sub-categories/{id}', 'GeneralController@getSubCategories')->name('getSubCategories');
Route::get('/get-sub-categories/by-slug/{slug}', 'GeneralController@getSubCategoriesBySlug')->name('getSubCategoriesBySlug');

//Home
Route::get('/', 'GeneralController@HomePage')->name('Home');
Route::get('/home', 'GeneralController@HomePage')->name('HomePage');

//How To
Route::get('/how-to-shop', 'GeneralController@howToShop')->name('howToShop');
Route::get('/how-to-sell', 'GeneralController@howToSell')->name('howToSell');
Route::get('/how-to-buy', 'GeneralController@howToBuy')->name('howToBuy');

//Shop
Route::get('/shop/{slug}', 'GeneralController@shopView')->name('shopView');
Route::get('/shop/{slug}/all-products/', 'GeneralController@shopAllProducts')->name('shopAllProducts');

//Products
Route::get('/product/{slug}', 'GeneralController@productView')->name('productView');

//Shop Owner Profile
Route::get('/shop-owner/{slug}', 'GeneralController@shopOwner')->name('shopOwner');
Route::get('/shop-owner/{slug}/all-shops', 'GeneralController@shopOwnerAllShops')->name('shopOwnerAllShops');
Route::get('/shop-owner/{slug}/all-products', 'GeneralController@shopOwnerAllProducts')->name('shopOwnerAllProducts');

//Contact Us
Route::get('/help-support', 'GeneralController@helpSupport')->name('helpSupport');
Route::post('/contact-us', 'ContactUsController@contactUs')->name('contactUs');



/********************* Search Filters **********************/
Route::get('/products/search/','GeneralController@searchProduct')->name('searchProduct');
Route::get('/shops/search/','GeneralController@searchShop')->name('searchShop');



/************************** Api Testing **************************/
Route::get('/api/get/shops/','ShopController@apiGetShops');







// Frontend Routes
// ../site map
Route::get('/sitemap.xml', 'SiteMapController@siteMap')->name('siteMap');
Route::get('/{lang}/sitemap', 'SiteMapController@siteMap')->name('siteMapByLang');

//Route::get('/', 'FrontendHomeController@HomePage')->name('Home');
// ../home url
//Route::get('/home', 'FrontendHomeController@HomePage')->name('HomePage');
Route::get('/{lang?}/home', 'FrontendHomeController@HomePageByLang')->name('HomePageByLang');
// ../subscribe to newsletter submit  (ajax url)
Route::post('/subscribe', 'FrontendHomeController@subscribeSubmit')->name('subscribeSubmit');
// ../Comment submit  (ajax url)
Route::post('/comment', 'FrontendHomeController@commentSubmit')->name('commentSubmit');
// ../Order submit  (ajax url)
Route::post('/order', 'FrontendHomeController@orderSubmit')->name('orderSubmit');
// ..Custom URL for contact us page ( www.site.com/contact )
Route::get('/contact', 'FrontendHomeController@ContactPage')->name('contactPage');
Route::get('/{lang?}/contact', 'FrontendHomeController@ContactPageByLang')->name('contactPageByLang');
// ../contact message submit  (ajax url)
Route::post('/contact/submit', 'FrontendHomeController@ContactPageSubmit')->name('contactPageSubmit');
// ..if page by name ( ex: www.site.com/about )
Route::get('/topic/{id}', 'FrontendHomeController@topic')->name('FrontendPage');
// ..if page by user id ( ex: www.site.com/user )
Route::get('/user/{id}', 'FrontendHomeController@userTopics')->name('FrontendUserTopics');
Route::get('/{lang?}/user/{id}', 'FrontendHomeController@userTopicsByLang')->name('FrontendUserTopicsByLang');
// ../search
Route::post('/search', 'FrontendHomeController@searchTopics')->name('searchTopics');

// ..Topics url  ( ex: www.site.com/news/topic/32 )
Route::get('/{section}/topic/{id}', 'FrontendHomeController@topic')->name('FrontendTopic');
Route::get('/{lang?}/{section}/topic/{id}', 'FrontendHomeController@topicByLang')->name('FrontendTopicByLang');

// ..Sub category url for Section  ( ex: www.site.com/products/2 )
Route::get('/{section}/{cat}', 'FrontendHomeController@topics')->name('FrontendTopicsByCat');
Route::get('/{lang?}/{section}/{cat}', 'FrontendHomeController@topicsByLang')->name('FrontendTopicsByCatWithLang');

// ..Section url by name  ( ex: www.site.com/news )
Route::get('/{section}', 'FrontendHomeController@topics')->name('FrontendTopics');
Route::get('/{lang?}/{section}', 'FrontendHomeController@topicsByLang')->name('FrontendTopicsByLang');

// ..SEO url  ( ex: www.site.com/title-here )
Route::get('/{seo_url_slug}', 'FrontendHomeController@SEO')->name('FrontendSEO');
Route::get('/{lang?}/{seo_url_slug}', 'FrontendHomeController@SEOByLang')->name('FrontendSEOByLang');

// ..if page by name and language( ex: www.site.com/ar/about )
Route::get('/{lang?}/topic/{id}', 'FrontendHomeController@topicByLang')->name('FrontendPageByLang');

// .. End of Frontend Route
/*
 !! Important note:
    For new routes add them before // Frontend Routes
    If you added them after Frontend Routes they wouldn't work.
 */
Route::get('withdraw_amount','OrderController@withdraw_amount');
    Route::post('withdraw_amount','OrderController@post_withdraw_amount');

    // Order
    Route::get('/recharge_e_wallet','OrderController@recharge_e_wallet')->name('hellll');
    Route::post('/recharge_e_wallet','OrderController@post_recharge_e_wallet')->name('postRecharge');

    // Route::get('/recharge_e_wallet','OrderController@recharge_e_wallet');
    // Route::post('/recharge_e_wallet','OrderController@post_recharge_e_wallet')->name('rechargePost');
