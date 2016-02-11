
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">3 adults 2 rooms</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          	<div class="col-sm-6 rooms">
            	<h3>Room1</h3>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Adults</h4>
                        <h5>(12+)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Children</h4>
                        <h5>(0 - 11)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 rooms">
            	<h3>Room2</h3>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Adults</h4>
                        <h5>(12+)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Children</h4>
                        <h5>(0 - 11)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
            </div>
        </div>
        <a class="pull-right" href="#"> + Add more </a>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


        	<div class="col-lg-3 col-md-3">
            	<div class="panel-group" id="accordion">
                 <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Search Accommodation<span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row">
                        	<div class="col-xs-6">
                            	<input class="datepicker"  type="text" placeholder="Check in Date">
                            </div>
                            <div class="col-xs-6">
                            	<input class="datepicker" type="text" placeholder="Check in Date">
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-xs-6">
                            	<label>No of Nights</label>
                            </div>
                            <div class="col-xs-6">
                            	<input type="text" placeholder="Defaults">
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-sm-12 special" >
                           		<select data-toggle="modal" data-target="#myModal">
                                	<option>2 adults 1 room</option>
                                    <option>2 adults 1 room</option>
                                    <option>2 adults 1 room</option>
                                    <option>2 adults 1 room</option>
                                    <option>2 adults 1 room</option>
                                </select>
                            </div>
                        </div>
                        <div class="row type">
                        	<div class="col-sm-12">
                            	No of guest in room Units
                            </div>
                            <div class="col-sm-12">
                            	<input type="text" placeholder="Defaults">
                            </div>
                        </div>
                        <div class="row type">
                        	<div class="col-sm-12">
                            	Type
                            </div>
                            <div class="col-sm-12">
                            <?php // echo form_dropdown('rest_name', $rest_list);?>
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>--Region/City--</option>
                                    <option>Bangkok and Central</option>
                                    <option>Northern</option>
                                    <option>Southern</option>
                                    <option>Eastern</option>
                                    <option>Western</option>
                                    <option>North Eastern </option>
                                </select>
                            </div>
                        </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Area
                            </div>
                            <div class="col-sm-12">
                                <select class="multiple_select" multiple>
                                    <option selected>-----Any------</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                </select>
                            </div>
                         </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Keyword
                            </div>
                            <div class="col-sm-12">
                                <input type="text">
                            </div>
                         </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Additional search option
                            </div>
                            <div class="col-sm-12">
                                <select class="multiple_select" multiple>
                                    <option selected>-----Any------</option>
                                    <option>Pool Villa</option>
                                    <option>Pets Allowed</option>
                                    <option>Mountain view</option>
                                    <option>beach front</option>
                                    <option>Golf Club</option>
                                    <option>BTS / MRT Airport link </option>
                                    <option>Boutique Hotel</option>
                                    <option>Green Hotel</option>
                                    <option>Therapeutic /health and wellness</option>
                                    <option>Adventure / natural</option>
                                </select>
                            </div>
                         </div>
                         <input type="button" class="search_btn" value="Search">
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          Search Dining out <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row type">
                        	<div class="col-sm-12">
                            	Type
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>-----Any------</option>
                                    <option>buffet</option>
                                    <option>Coffee / Bakery shop</option>
                                    <option>Pub and restaurant</option>
                                    <option>River cruise with meal</option>
                                    <option>Seafood</option>
                                    <option>Street food</option>
                                    <option>Authentic Thai cuisine</option>
                                    <option>Fusion Food</option>
                                    <option>Thai Noodle</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>--Region/City--</option>
                                    <option>Bangkok and Central</option>
                                    <option>Northern </option>
                                    <option>Southern</option>
                                    <option>Eastern</option>
                                    <option>Western</option>
                                    <option>North Eastern </option>
                                </select>
                            </div>
                        </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Area
                            </div>
                            <div class="col-sm-12">
                                <select class="multiple_select" multiple>
                                    <option selected>-----Any------</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                </select>
                            </div>
                         </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Keyword
                            </div>
                            <div class="col-sm-12">
                                <input type="text">
                            </div>
                         </div>
                        <input type="button" class="search_btn" value="Search">
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          Search Things to do <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row type">
                        	<div class="col-sm-12">
                            	Type
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>-----Any------</option>
                                    <option>Bike Tour / Bike rental</option>
                                    <option>Diving / Snockerling</option>
                                    <option>Cruises</option>
                                    <option>Cooking</option>
                                    <option>Theatres, shows and concerts</option>
                                    <option>Theme parks</option>
                                    <option>Water sports, kayaking</option>
                                    <option> Moutain hiking and elephant trekking</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>--Region/City--</option>
                                    <option>Bangkok and Central</option>
                                    <option>Northern </option>
                                    <option>Southern</option>
                                    <option>Eastern</option>
                                    <option>Western</option>
                                    <option>North Eastern </option>
                                </select>
                            </div>
                        </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Area
                            </div>
                            <div class="col-sm-12">
                                <select class="multiple_select" multiple>
                                    <option selected>-----Any------</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                </select>
                            </div>
                         </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Keyword
                            </div>
                            <div class="col-sm-12">
                                <input type="text">
                            </div>
                         </div>
                        <input type="button" class="search_btn" value="Search">
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                          Search E - local & Package <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div class="row type">
                        	<div class="col-sm-12">
                            	Type
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>-----Any------</option>
                                    <option>Package 1 day trip</option>
                                    <option>Package home stay Traditional  Thai life style</option>
                                    <option>package scuba snorkeling diving </option>
                                    <option>"Package Trekking + Camping</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                            	<select class="multiple_select" multiple>
                                	<option selected>--Region/City--</option>
                                    <option>Bangkok and Central</option>
                                    <option>Northern </option>
                                    <option>Southern</option>
                                    <option>Eastern</option>
                                    <option>Western</option>
                                    <option>North Eastern </option>
                                </select>
                            </div>
                        </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Area
                            </div>
                            <div class="col-sm-12">
                                <select class="multiple_select" multiple>
                                    <option selected>-----Any------</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                    <option>Top destination</option>
                                </select>
                            </div>
                         </div>
                        <div class="row type">
                            <div class="col-sm-12">
                                Keyword
                            </div>
                            <div class="col-sm-12">
                                <input type="text">
                            </div>
                         </div>
                        <input type="button" class="search_btn" value="Search">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="space15"></div>
                <div class="panel-group black_colleps" id="accordion2">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse33">
                          Filter Your Result
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse33">
                          Number of Bandrooms 
                          <select style="width:50px; margin-top:-7px;" class="fr">
                          	<option>1</option>
                            <option>1</option>
                            <option>1</option>
                            <option>1</option>
                          </select>
                        </a>
                      </h4>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse55">
                          Price per Night <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse55" class="panel-collapse collapse">
                      <div class="panel-body">
                        <label><input type="radio"> Up to US$ 100</label>
                        <label><input type="radio"> Up to US$ 100</label>
                        <label><input type="radio"> Up to US$ 100</label>
                        <label><input type="radio"> Up to US$ 100</label>
                        <label><input type="radio"> Up to US$ 100</label>
                        <label><input type="radio"> Up to US$ 100</label>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse66">
                          Type pf property <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse66" class="panel-collapse collapse">
                      <div class="panel-body">
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse77">
                          Amenities <span class="glyphicon glyphicon-plus fr"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse77" class="panel-collapse collapse">
                      <div class="panel-body">
                        <label><input type="checkbox"> Internet/WIFI (500+)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                        <label><input type="checkbox"> Holiday home (57)</label>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            
            <script>
				var jq = $.noConflict();
				jq(".datepicker").datepicker({
					inline: true
				});
			</script>
			<script>
				$(document).ready(function(e) {
			        jQuery(document).ready(function($){
						$('.crsl-items1').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
						$('.crsl-items2').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
						$('.crsl-items3').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
						$('.crsl-items4').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
						$('.crsl-items5').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
						$('.crsl-items6').carousel({ visible: 4, itemMinWidth: 200, itemMargin: 0 });
					});
			    });
			</script>
        