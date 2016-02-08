<div class="image-map img-responsive top"> 

<?php foreach($products as $product): ?>
		
	<!-- set css theme prefix for id and class -->
		<!-- Classic -->
	<?php if($product['category_slug'] == 'themes/classic/featured') : ?>
   		<?php $css_prefix = "c"; ?>
   		<!-- Arctic -->
   	<?php elseif($product['category_slug'] == 'themes/arctic/featured') : ?>
    	<?php $css_prefix = "a"; ?>
	<?php else : ?>
		<!-- Woodland -->
    	<?php $css_prefix = "w"; ?>
	<?php endif; ?>
	 
		<!-- Image map featured items  -->
		<button type="button" id="<?php echo $css_prefix . $product['sort_order']; ?>" class="<?php echo $product['product_id']; ?>_popbtn <?php echo $css_prefix; ?>buttons map"
				data-toggle="popover"
				data-placement="auto left"
				data-delay="{show: 50, hide: 400}"
		   		data-original-title="<?php echo "<p>". htmlentities($product['name'], ENT_QUOTES, "UTF-8") . "</p>"; ?>
				<?php echo "<p><strong>" . "$" . $product['price'] . "</strong></p>"; ?>">
				<?php echo $product['sort_order']; ?>
		</button>
		
		<div class="popover_content_wrapper popover" style="display: none;" id="<?php echo $product['product_id']; ?>_popover">
			<div class="form-group">
			 	<input type="hidden" id="<?php echo $product['product_id']; ?>_qty" name="quantity" value="1">
				<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
				<button type="button" id="<?php echo $product['product_id']; ?>_btn" class="btn btn-soft-green cart-add" onclick='addTocart(<?php echo $product['product_id']; ?>)'><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
			</div>
		</div>

		<!-- Mobile navbar -->
		<div id="mobile-nav">
			<div id="<?php echo $product['product_id']; ?>_navbar">
				<button type="button" class="mobile-btn popper"
					data-toggle="popover"
					data-trigger="click hover"
					data-delay="{show: 50, hide: 400}">
					<?php echo $product['sort_order']; ?>
				</button>
				
				<div class="popper_content_wrapper hide">
					<?php echo htmlentities($product['name'], ENT_QUOTES, "UTF-8") . "<br />"; ?>
					<?php echo "<strong>" . "$" . $product['price'] . "</strong><br />"; ?>
					<input type="hidden" id="<?php echo $product['product_id']; ?>_qty" name="quantity" value="1">
					<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
					<button type="button" id="<?php echo $product['product_id']; ?>_btn" class="btn btn-xs btn-soft-green cart-add" onclick='addTocart(<?php echo $product['product_id']; ?>)'><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
				</div>
			</div>
		</div>
		
		<script>
			
			// Create popover for each item in product array
			//
			$('.<?php echo $product['product_id']; ?>_popbtn').popover({
				trigger: 'manual',
				html: true,
				animation:false,
				container: 'body',
				content: function() {
					return $("#<?php echo $product['product_id']; ?>_popover").html();
					}	
				})
				// Enter image map link
				//
	    		.on("mouseenter", function () {
		        	var _this = this;
		        	$(this).popover("show");
		        	
		        	// leave popover wrapper
		        	$('.popover').on("mouseleave", function () {
		            	$(_this).popover('hide');
	        		});
	        		
	        	// Leave image map link
	        	//
	    		}).on("mouseleave", function () {
	        		var _this = this;
	        		setTimeout(function () {
	            	if (!$(".popover:hover").length) {
	                	$(_this).popover("hide");
	            	}
	        	}, 200);
			});
						  
			// Create mobile navbar
			$('#theme-items').append($('#<?php echo $product['product_id']; ?>_navbar').html());
			  
		</script>
	
<?php endforeach; ?>
</div>

<!-- Navbar -->
<script>
   	
	$('.popper').popover({
		html: true,
    	placement: 'bottom',
    	container: 'body',
    	content: function () {
			return $(this).next('.popper_content_wrapper').html();
    	}
	});
	
</script>