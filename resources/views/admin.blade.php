<!DOCTYPE html>
<html>
<title>Hom's Kitchen - Administrator Panel</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="/js/admin.js"></script>
<body ng-app="adminApp" ng-controller="AdminCtrl" ng-init="init()">
<!--
<title>Admin Panel</title>
<a href="/items/list">Items</a><br>
<a href="/notifications/create">Create a notification</a><br>
<a href="/locations/list">Locations</a><br>
<a href="/orders">Unpaid Orders</a><br>
<a href="/orders?all=true">All Orders (BE CAREFUL THIS MAY TAKE A WHILE)</a><br>
-->
<?php
    session_start();
    
    if(isset($_POST['password']) && isset($_POST['email'])) {
        if($_POST['password'] == getenv('MAIL_PASSWORD') &&
                $_POST['email'] == getenv('MAIL_USERNAME')) {
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['email'] = $_POST['email'];
        }
    }
    
    if(!isset($_SESSION['password'])) {
    // Display login form
?>
<div class="container-fluid">
    <div class="row">
	    <div class="col-md-4">
	    </div>
	    <div class="col-md-4 text-center">
		    <div class="panel panel-default">
			    <div class="panel-heading">
				    <h3 class="panel-title">
					    Administrator Login
				    </h3>
			    </div>
			    <div class="panel-body">
				    <form role="form" method="POST" action="/admin">
				        <!-- Token -->
                        <input type="hidden" name="_token"
                            value="{{{ csrf_token() }}}">
                        
			            <div class="form-group">
				            <label for="email">
					            Email address
				            </label>
				            <input type="email" name="email"
				                class="form-control" id="email" />
			            </div>
			            <div class="form-group">
				            <label for="password">
					            Password
				            </label>
				            <input type="password" name="password"
				                class="form-control" id="password" />
			            </div>
			            
			            <button type="submit" class="btn btn-default">
				            Submit
			            </button>
		            </form>
			    </div>
		    </div>
	    </div>
	    <div class="col-md-4">
	    </div>
    </div>
</div>
<?php
} else {
// Logged in as administrator
?>

<!-- Modals -->
<!-- Add location modal -->
<div id="addLocationsModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Location</h4>
            </div>
            <div class="modal-body">
                <div id="addLocationsErrorDiv" 
                    class='alert alert-danger hidden'>
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    &nbsp;
                    <span id="addLocationsErrorMessage"></span>
                </div>

                <!-- Begin form -->
                <form name="addLocationsForm" role="form">
                    <div class="form-group has-feedback">
                        <label for="location">Location:</label>
                        <textarea class="form-control" rows="5" name="location"
                            id="locationsLocation" 
                            ng-model="addLocationsForm.location"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <img id="addLocationLoaderGif" src="/images/ajax-loader.gif"
                    class="hidden"/>
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"
                    ng-click="addLocation()">Add location</button>
            </div>
        </div>
    </div>
</div>

<!-- Begin actual body -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <a class="navbar-brand">Hom's Kitchen</a>
				</div>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-2">
			<ul class="nav nav-tabs nav-stacked">
			    <li class="disabled">
					<a href="#">Navigation</a>
				</li>
				<li class="enabled active">
					<a href="#">Item List</a>
				</li>
				<li class="enabled">
					<a href="#">Orders List</a>
				</li>
				<li class="enabled">
					<a href="#">Locations List</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div id="content-title" class="panel-heading">
					<h3 class="panel-title">
						Panel title
					</h3>
				</div>
				<div id="content-body" class="panel-body">
					Panel content
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>

<?php
}
?>
</body>
</html>
