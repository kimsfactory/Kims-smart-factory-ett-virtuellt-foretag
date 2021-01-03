				<!--Show error message-->
				<?php
				if (isset($_SESSION['msg'])) {
					echo $_SESSION['msg'];
				}
				?>
				<br>
				<form action="create-order.php" method="POST">
					<input type="hidden" name="totalPrice" value="<?=$cartTotalSum?>">
	  				<div class="form-row">
						<div class="form-group col-md-6">
					    	<label for="inputEmail4">First name</label>
					      	<input type="text" class="form-control" name="firstName" id="inputEmail4" placeholder="First name">
					    </div>
					    <div class="form-group col-md-6">
					      	<label for="inputPassword4">Last name</label>
					      	<input type="text" class="form-control" name="lastName" id="inputPassword4" placeholder="Last name">
					    </div>
					    <div class="form-group col-md-6">
					      	<label for="inputEmail4">E-mail</label>
					      	<input type="email" class="form-control" name="email" id="inputEmail4" placeholder="aaa@bbb.com">
					    </div>
					    <div class="form-group col-md-6">
					      	<label for="inputPassword4">Password</label>
					      	<input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
					    </div>
					</div>
						<div class="form-row">
					  		<div class="form-group col-md-6">
					    		<label for="inputAddress">Address</label>
					    		<input type="text" class="form-control" name="street" id="inputAddress" placeholder="Address">
					  		</div>
					  		<div class="form-group col-md-6">
					      		<label for="inputZip">Postal code</label>
					      		<input type="text" class="form-control" name="postalCode" id="inputZip" value="123 45">
					    	</div>
					    </div>
					  	<div class="form-row">
					  		<div class="form-group col-md-6">
					      		<label for="inputZip">Phone</label>
					      		<input type="text" class="form-control" name="phone" value="Home or Mobile phone">
					    	</div>
					    	<div class="form-group col-md-3">
					      		<label for="inputCity">City</label>
					      		<input type="text" class="form-control" name="city" id="inputCity" value="city">
					    	</div>
					    	<div class="form-group col-md-3">
					      		<label for="inputState">Country</label>
					      		<select name="country" id="inputState" class="form-control">
					       			<option value="SE">Sweden</option>
					      		</select>
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<div class="form-check">
					      		<input class="form-check-input" type="checkbox" id="gridCheck">
					      		<label class="form-check-label" for="gridCheck">
					        		I have read and agreed to policies.
					      		</label>
					    	</div>
					  	</div>
					  	<button type="submit" class="btn btn-primary" name="createOrderBtn">Purchase</button>
				</form>	