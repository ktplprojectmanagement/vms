
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-rc.0/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-rc.0/angular-messages.min.js"></script>
<script src="<?php echo base_url().'js/angular_script.js'; ?>"></script>

<body ng-app="myApp">
<form name="myForm">
<p>Name:
<input name="myName" ng-model="myName" required ng-pattern="/^[0-9]*$/" ng-maxlength="10">
<div ng-messages="myForm.myName.$error">
      <p ng-message="required">Providing a username is mandatory.</p>
      <p ng-message="pattern">Username can only be alphanumeric with an optional underscore.</p>
      <p ng-message="minlength">Username should have at least 6 characters.</p>
      <p ng-message="maxlength">Username should have at most 12 characters.</p>
    </div>
</p>

<p>Address:
<input name="myAddress" ng-model="myAddress" required>
</p>

</form>


<div ng-app="myApp" ng-controller="myCtrl">
    Name: <input ng-model="name">
    <p>{{name}}</p>
</div>



</body>
