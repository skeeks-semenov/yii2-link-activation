/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

(function(sx, $, _)
{
    /**
     *
     */
    sx.classes.LinkActivation = sx.classes.Component.extend({

        /**
         * @param id
         * @param opts
         */
        construct: function(Selector, opts)
        {
            opts = opts || {};
            this.Selector = jquerySelector || false;

            this.applyParentMethod(sx.classes.Component, 'construct', [opts]);
        }

        _onDomReady: function()
        {
            this.jQuerySelector = $(this.Selector);

        }
    });
})(sx, sx.$, sx._);