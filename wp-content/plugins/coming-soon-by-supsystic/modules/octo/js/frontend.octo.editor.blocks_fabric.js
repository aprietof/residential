/**
 * Blocks fabric - main object for whole blocks manipulations
 */
/**
 * Trigger this right after element was dropped to canvas
 * @param {jquery} helper current dragged element
 * @param {jquery} highlighter current highlighter on canvas element
 */
scsBlockFabric.prototype.addFromDrag = function(helper, highlighter) {
	var block = this.add( g_scsBlocksById[ helper.data('id') ] );
	block.build({
		insertAfter: highlighter
	});
	//block.getRaw().insertAfter( highlighter );
	helper.remove();
};
scsBlockFabric.prototype.checkSortStart = function( ui ) {
	if(!this._isSorting) {
		this._sortStart( ui );
		this._isSorting = true;
	}
};
scsBlockFabric.prototype._sortStart = function( ui ) {
	if(this._blocks.length) {
		var height = 178
		,	margin = 20
		,	draggedId = ui.item.attr('id')
		,	elementFound = false
		,	canvaPaddTop = 0
		,	canvaPaddBottom = 0
		,	currentScroll = jQuery(document).scrollTop()
		,	newDocScroll = currentScroll
		,	totalHeight = 0;
		for(var i = 0; i < this._blocks.length; i++) {
			var rawJq = this._blocks[ i ].getRaw()
			,	originalHeight = rawJq.height();
			height = originalHeight * 0.5;
			if(height > 178)
				height = 178;
			rawJq.addClass('scsInSortProcess')
				.data('original-height', originalHeight)
				.animate({
					'height': height+ 'px'
				,	'margin-top': margin+ 'px'
				}, this._animationSpeed, function(){
					/*console.time('sortable - refreshPositions');
					jQuery('#scsCanvas').sortable('refreshPositions');
					console.timeEnd('sortable - refreshPositions');*/
				})
				.find('.scsBlockContent').zoom( 0.5, 'center top' );
				
			if(rawJq.attr('id') == draggedId) {
				elementFound = true;
			}
			var newFullHeight = height + margin;
			elementFound
				? canvaPaddBottom += originalHeight - newFullHeight
				: canvaPaddTop += originalHeight - newFullHeight;
			if(!draggedId && currentScroll && currentScroll >= totalHeight) {
				newDocScroll -= originalHeight - newFullHeight;
			}
			totalHeight += originalHeight;
		}
		setTimeout(function(){
			jQuery('#scsCanvas').sortable('refreshPositions');
		}, this._animationSpeed);
		if(draggedId) {
			jQuery('#scsCanvas').css({
				'padding-top': canvaPaddTop
			,	'padding-bottom': canvaPaddBottom
			});
		} else {
			if(currentScroll) {
				if(newDocScroll < 0)
					newDocScroll = 0;
				jQuery(document).scrollTop( newDocScroll );
			}
		}
	}
};
scsBlockFabric.prototype.checkSortStop = function( ui ) {
	if(this._isSorting) {
		this._sortStop( ui );
		this._isSorting = false;
	}
};
scsBlockFabric.prototype._sortStop = function( ui ) {
	if(this._blocks.length) {
		var height = 178
		,	margin = 20
		,	draggedId = ui.item.attr('id')
		,	newDocScroll = 0
		//,	scrollToIter = 0
		,	scrolledBlockPass = false
		,	currentScroll = jQuery(document).scrollTop()
		,	totalHeight = 0
		,	offsetTop = ui.offset.top + ui.placeholder.height();
		for(var i = 0; i < this._blocks.length; i++) {
			var rawJq = this._blocks[ i ].getRaw()
			,	originalHeight = rawJq.data('original-height');
			height = rawJq.height();
			rawJq.removeClass('scsInSortProcess')
				.animate({
					'height': originalHeight
				,	'margin-top': '0'
				}, this._animationSpeed)
				.find('.scsBlockContent').zoom( 1 );
			
			if(draggedId && !scrolledBlockPass) {
				newDocScroll += originalHeight;
			}
			if(draggedId && rawJq.attr('id') == draggedId) {
				scrolledBlockPass = true;
			}
			
			if(!draggedId && totalHeight <= offsetTop) {
				newDocScroll += originalHeight;
			}
			totalHeight += height + margin;
		}
		jQuery('#scsCanvas').css({
			'padding-top': 0
		,	'padding-bottom': 0
		});
		jQuery(document).scrollTop( newDocScroll );
	}
};
scsBlockFabric.prototype.getDataForSave = function() {
	var res = [];
	if(this._blocks.length) {
		var prevDocScroll = jQuery(document).scrollTop();
		this.updateSortOrder();
		var requiredKeys = ['id', 'params', 'sort_order', 'original_id'];
		for(var i = 0; i < this._blocks.length; i++) {
			var requiredParams = {};
			for(var j = 0; j < requiredKeys.length; j++) {
				requiredParams[ requiredKeys[j] ] = this._blocks[ i ].get( requiredKeys[j] );
			}
			this._blocks[ i ].beforeSave();
			requiredParams.html = this._blocks[ i ].getHtml();
			this._blocks[ i ].afterSave();
			res.push( requiredParams );
		}
		jQuery(document).scrollTop( prevDocScroll );
	}
	return res;
};
scsBlockFabric.prototype.updateSortOrder = function() {
	if(this._blocks.length) {
		for(var i = 0; i < this._blocks.length; i++) {
			this._blocks[ i ].set('sort_order', this._blocks[ i ].getRaw().index());
		}
	}
};
scsBlockFabric.prototype.getBlocks = function() {
	return this._blocks;
};
scsBlockFabric.prototype.removeBlockByIter = function(iter) {
	if(this._blocks.length && this._blocks[ iter ]) {
		this._blocks.splice(iter, 1);
		if(this._blocks.length) {
			// Update iterators for blocks
			for(var i = 0; i < this._blocks.length; i++) {
				this._blocks[ i ].setIter( i );
			}
		}
	}
};
scsBlockFabric.prototype.beforeSave = function() {
	if(this._blocks.length) {
		for(var i = 0; i < this._blocks.length; i++) {
			this._blocks[ i ].beforeSave();
		}
	}
};
scsBlockFabric.prototype.afterSave = function() {
	if(this._blocks.length) {
		for(var i = 0; i < this._blocks.length; i++) {
			this._blocks[ i ].afterSave();
		}
	}
};
scsBlockFabric.prototype.getElementsByCode = function(code) {
	var res = [];
	if(this._blocks.length) {
		for(var i = 0; i < this._blocks.length; i++) {
			var elements = this._blocks[ i ].getElements();
			if(elements && elements.length) {
				for(var j = 0; j < elements.length; j++) {
					if(elements[ j ].getCode() == code) {
						res.push( elements[ j ] );
					}
				}
			}
		}
	}
	return res.length ? res : false;
};