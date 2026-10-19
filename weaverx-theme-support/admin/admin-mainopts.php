<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/* Weaver Xtreme - admin Main Options
 *
 *  __ added: 12/9/14
 * This function will start the main sapi form, which will be closed in admin-adminopts
 */

// ======================== Main Options > Top Level ========================
function weaverx_admin_mainopts(): void
{
    // Split into 3 files for easier refactoring
    require_once(dirname(__FILE__) . '/admin-mainopts-1.php');
    require_once(dirname(__FILE__) . '/admin-mainopts-2.php');
    require_once(dirname(__FILE__) . '/admin-mainopts-3.php');
    weaverx_admin_mainopts_start();
}
