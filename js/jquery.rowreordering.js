/*
* File:        jquery.rowreordering.js
* Version:     1.0.0.
* Author:      ChiLT
* 
*
* This source file is free software, under either the GPL v2 license or a
* BSD style license, as supplied with this software.
* 
* This source file is distributed in the hope that it will be useful, but 
* WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
* or FITNESS FOR A PARTICULAR PURPOSE. 
* 
* Parameters:
* @sOrderURL                       String      URL of the server-side page used for updating order row.

*/
(function ($) {

	$.fn.rowsReOrdering = function (options) {

		var defaults = {
		    cursor : 'move',
		    items:'tr',
		    handle: '.move',
		    axis: 'y',
		    sOrderURL: 'URL'
		},
		settings = $.extend({}, defaults, options);

		this.each(function() {
			var $this = $(this);

		    //Rows Reordering
		    //function keeping the width of TR 
		    $this.sortable({
		            cursor: settings.cursor,
		            items: settings.items,
		            handle: settings.handle,
		            axis: settings.axis,
		            helper: function(e, ui) {
		                ui.children().each(function() {
		                    $(this).width($(this).width());
		                });
		                return ui;
		            },
		            update: function (e, ui) {
		                var order = $(this).sortable("toArray");
		                $.ajax({
		                    url: settings.sOrderURL,
		                    type: 'POST',
		                    dataType: 'html',
		                    data: {"order": order},
		                    beforeSend: function(){},
		                    error: function(xhr, textStatus, errorThrown) {},
		                    success: function(data, textStatus, xhr) {
		                        if(data !== "") alert(data);
		                        else alert("Rows have been sorted!");
		                    }
		                });

		            }

		    }).disableSelection();

		});


		// returns the jQuery object to allow for chainability.
		return this;

	};

})(jQuery);