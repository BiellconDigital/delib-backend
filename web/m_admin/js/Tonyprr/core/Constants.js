/**
 * @class Tonyprr.lib.Constants
 * @extends Object
 * requires 
 * @autor Antonio Ramos
 * @date 
 * @version 1.5
 * Description
 *
 *
 **/

Ext.define("Tonyprr.core.Constants",{
    alternateClassName	: "Tonyprr.Constants" ,
    singleton	: true,
    LOGIN_URL   : Tonyprr.BASE_URL+"/admin/login/access",
    HOME_URL   : Tonyprr.BASE_URL+"/admin",

    /* El directorio de los JS */
    JS_PATH : Tonyprr.BASE_PATH+"/m_admin/js",
    FILES_DATA : Tonyprr.BASE_PATH+"/m_web/files",
    FILES_DATA_CART : Tonyprr.BASE_PATH+"/m_cart/files",
//    EXTJS_PATH : Tonyprr.BASE_PATH+"/../../libs/Ext",

    DEFAULT_WINDOW_WIDTH		: 800,
    DEFAULT_WINDOW_HEIGHT		: 480,
    LOGIN_IMAGE     : Tonyprr.BASE_PATH+"/m_admin/images/login.jpg",
    SYSTEM_CONFIGURATION_URL   :  Tonyprr.BASE_URL+"/admin/index/config",
    PATH_ICONS     : Tonyprr.BASE_PATH+"/common/images/icons",
    IMAGE_ACEPT     : Tonyprr.BASE_PATH+"/common/images/icons/accept.png",
    IMAGE_EDIT     : Tonyprr.BASE_PATH+"/common/images/icons/application_form_edit.png",
    IMAGE_CROSS     : Tonyprr.BASE_PATH+"/common/images/icons/cross.gif",
    IMAGE_REFRESH     : Tonyprr.BASE_PATH+"/common/images/icons/arrow_refresh.png"
});