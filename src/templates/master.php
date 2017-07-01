<?php
include __DIR__ . "/../config.php";

?>
<!-- Headline -->
<div class="row">
  <div class="col-xs-12">
    <h1>{{ master.id }} - {{ master.name }}</h1>
  </div>
</div>
      
<!-- Poll control -->
<div class="row topic">
  <div class="col-xs-12">
    <ul class="nav nav-tabs">
      <li ng-class="{active: master.current == source}" ng-repeat="source in master.sources| orderBy: 'position'">
        <a class="selectable" ng-click="master.selectSource(source)">{{ source.name }}</a>
      </li>
    </ul>
    <div class="ticketing" ng-include="master.current.view">
    </div>
  </div>
</div>
  
<!-- Live poll view and statistics -->
<div class="row">
  <div class="card-overview">
    <div ng-repeat="vote in master.votes track by vote.id" class="col-lg-2 col-sm-3 col-xs-4">        
      <div class="card-container">
        <div class="deletable-card">
          <div class="card-flip" ng-class="{flipped: master.flipped}">
            <div class="card front" ng-class="{active: vote.active}">
              <div ng-if="vote.placed" class="inner"><span class="card-label">?</span></div>
            </div>
            <div class="card back" ng-class="{active: vote.active, confirmed: master.consensus}">
              <div class="inner"><span class="card-label" ng-bind-html="vote.value"></span></div>
            </div>
          </div>
          <div class="delete-member remove selectable" ng-click="master.remove(vote.id)">
            <span class="glyphicon glyphicon-remove"></span>
          </div>
        </div>
        <h2 ng-bind="vote.name"></h2>
      </div>            
    </div>
  </div> 
</div>           
            
<!-- Invite and statistics -->            
<div class="row">
  <div class="col-xs-12 col-md-5">
    <h2>Invite members</h1>
    <p>Invite members to join your session. Session id: <strong ng-bind="master.id"></strong></p>
<?php
$joinUrl = "https://". $host . "/join/";
?>
    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= urlencode($joinUrl) . "{{ master.id }}" ?>&choe=UTF-8" title="Join {{ master.id }}" />
<?php
$joinUrl = $joinUrl . "{{ master.id }}";
?>
    <p>Or send them this link: <a href="<?= $joinUrl ?>"><?= $joinUrl ?></a>
  </div>  
    
  <!-- Statistics column -->
  <div class="col-xs-12 col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">Statistics</div>
      <div class="panel-body">
        <p ng-hide="master.statistics">Statistics will appear as soon as the first poll is concluded!</p>
        <table class="table table-striped" ng-show="master.statistics">
          <thead>
            <tr>
              <th>Enabled</th>
              <th>Name</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="statistic in master.statistics | orderBy:'!enabled'">
              <td><input type="checkbox" ng-model="statistic.enabled"></td>
              <td>
                <a target="_blank" href="<?php echo $src ?>/src/controllers/statistics/{{statistic.name}}.php">
                  {{ statistic.name }}
                </a>
              </td>
              <td><span ng-show="statistic.enabled" ng-bind="statistic.value"></span></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <a target="_blank" href="<?php echo $src ?>/src/controllers/statistics">
                  Want more?
                </a>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
