<?php
    require "search-faculty.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Search Specific Faculty</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/global.css">
		<link rel="stylesheet" href="../css/searchspecific-faculty.css">
		<link rel="stylesheet" href="../css/dashboard.css">

		<link rel="stylesheet" href="../css/table.css">
		<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css"/>
		<!-- DROPDOWN-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css" rel="stylesheet">
		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Bungee|Gudea" rel="stylesheet">

		<link type="text/css" href="../css/bootstrap-timepicker.min.css" />
		<!--<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>-->

		<!--PAGINATION-->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="../js/jquery-3.0.0.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="../js/moment.js"></script>
	    <script src="../js/daterangepicker.js"></script>
		    <!-- DROPDOWN -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
	    <!--AUTOCOMPLETE CSS -->
	    <style>
	        #search-id-list, #search-name-list{
	            position: absolute;
	            top: 100%;
	            left: 0;
	            z-index: 1000;
	            display: none;
	            float: left;
	            min-width: 80px;
	            max-height:150px;
	            overflow:auto;
	            padding-left:5px;
	            margin: 2px 0 0;
	            margin-left:15px;
	            font-size: 14px;
	            font-weight:normal;
	            text-align: left;
	            list-style: none;
	            background-color: #fff;
	            -webkit-background-clip: padding-box;
	            background-clip: padding-box;
	            border: 1px solid #ccc;
	            border: 1px solid rgba(0,0,0,.15);
	            border-radius: 4px;
	            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
	            box-shadow: 0 6px 12px rgba(0,0,0,.175);
	        }

	        #search-name-list{
	          width: 90%;
	        }

	        #search-id-list, #search-name-list{
	          cursor:pointer;
	        }

	        .hover{
	            background-color:#f5f5f5;
	        }
	    </style>

	    <!-- AUTOCOMPLETE JS FOR ATTENDANCE RECORDS -->
	    <script type="text/javascript">

	      <!-- AutoComplet -->
	      function autocompletName() {
	        var min_length = 0; // min caracters to display the autocomplete
	        var keyword = $('#search-name').val();
	        if (keyword.length >= min_length) {
	          $.ajax({
	            url: 'ajax_refresh.php',
	            type: 'POST',
	            data: {keyword:keyword},
	            success:function(data){
	                $('#search-name-list').show();
	                $('#search-name-list').html(data);
	                $('#search-name-list li').mouseover(function(){
	                    $('#search-name-list li').removeClass("hover");
	                    $(this).addClass("hover");
	                });
	            }
	          });
	        } else {
	          $('#search-name-list').hide();
	        }
	      }
	 
	      // set_item : this function will be executed when we select an item
	      function set_itemName(item) {
	        // change input value
	        $('#search-name').val(item);
	        // hide proposition list
	        $('#search-name-list').hide();
	      }

	      <!-- AutoComplet -->
	      function autocompletId() {

	        var min_length = 0; // min caracters to display the autocomplete
	        var id = $('#search-idnumber').val();
	        if (id.length >= min_length) {
	          $.ajax({
	            url: 'ajax_refresh.php',
	            type: 'POST',
	            data: {id:id},
	            success:function(data){
	              $('#search-id-list').show();
	              $('#search-id-list').html(data);
	              $('#search-id-list li').mouseover(function(){
	                  $('#search-id-list li').removeClass("hover");
	                  $(this).addClass("hover");
	              }); 
	            }
	          });
	        } else {
	          $('#search-id-list').hide();
	        }
	      }
	 
	      // set_item : this function will be executed when we select an item
	      function set_item(item) {
	        // change input value
	        $('#search-idnumber').val(item);
	        // hide proposition list
	        $('#search-id-list').hide();
	      }
	    </script>

		<!-- SINGLE CALENDAR -->
	    <script>
	      $(function() {
	        var currDate = moment.currDate;
	        $('input[name="dailydate"]').daterangepicker({
	          singleDatePicker: true,
	          showDropdowns: true,
	          value: currDate
	        });
	      });

	    </script>
	    <!-- DATE RANGE PICKER -->
	    <script>
	      $(function() {
	        var start = moment().subtract(29, 'days');
	        var end = moment();

	        function cb(start, end) {
	          $('#reportrange span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
	          $('#reportrange2 span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
	          $('#reportrange3 span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
	        }
	        $('#reportrange').daterangepicker({
	          startDate: start,
	          endDate: end,
	          ranges: {}
	        }, cb);
	        $('#reportrange2').daterangepicker({
	          startDate: start,
	          endDate: end,
	          ranges: {}
	        }, cb);
	        $('#reportrange3').daterangepicker({
	          startDate: start,
	          endDate: end,
	          ranges: {}
	        }, cb);
	        cb(start, end);
	      });

	    </script>
	    <!-- SEARCH BY NAME/ID -->
	    <script>
	      $(document).ready(function() {
	        $('#inputName').click(function() {
	          var name = $("#name");
	          var idnumber = $("#idnumber");
	          name.removeAttr("readonly");
	          idnumber.val("");
	          //idnumber.removeAttr("required");
	          //name.prop("required", "true");
	          idnumber.prop("readonly", "true");
	        });
	        $('#inputID').click(function() {
	          var name = $("#name");
	          var idnumber = $("#idnumber");
	          name.prop("readonly", "true");
	          //idnumber.prop("required", "true");
	          //name.removeAttr("required");
	          idnumber.removeAttr("readonly");
	          name.val("");
	        });
	      });
	      $(document).ready(function() {
	        $('#searchByName').click(function() {
	          var name = $("#search-name");
	          var fname = $("#search-fname");
	          var idnumber = $("#search-idnumber");
	          name.removeAttr("readonly");
	          fname.removeAttr("readonly");
	          idnumber.val("");
	          idnumber.prop("readonly", "true");
	        });
	        $('#searchByID').click(function() {
	          var name = $("#search-name");
	          var fname = $("#search-fname");
	          var idnumber = $("#search-idnumber");
	          name.prop("readonly", "true");
	          fname.prop("readonly", "true");
	          idnumber.removeAttr("readonly");
	          name.val("");
	          fname.val("");
	        });
	      });
	      $(document).ready(function() {
	        $('#normalClassButton').click(function() {
	          $('#addNormalClass').show();
	          $('#addMakeUpClass').hide();
	        });
	        $('#makeupClassButton').click(function() {
	          $('#addNormalClass').hide();
	          $('#addMakeUpClass').show();
	        });
	      });

	    </script>

	    <!-- CHANGING OF REPORT TYPES -->
	    <script>
	      function change() {
	        if (document.getElementById('report-type').value == "daily") {
	          $("#inputDaily").show();
	          $("#inputMonthly").hide();
	          $("#inputTerm").hide();
	          $("#inputCustom").hide();
	        }
	        if (document.getElementById('report-type').value == "term") {
	          $("#inputTerm").show();
	          $("#inputDaily").hide();
	          $("#inputMonthly").hide();
	          $("#inputCustom").hide();
	          
	        }
	        if (document.getElementById('report-type').value == "custom") {
	          $("#inputCustom").show();
	          $("#inputTerm").hide();
	          $("#inputDaily").hide();
	          $("#inputMonthly").hide();
	        }
	        if (document.getElementById('report-type').value == "monthly") {
	          $("#inputMonthly").show();
	          $("#inputDaily").hide();
	          $("#inputTerm").hide();
	        }
	      }

	    </script>

	    <!-- CLICKING OF TABLES -->
	    <script>
	      $(document).ready(function($) {
	        $(".row-data").click(function() {
	          window.document.location = $(this).data("href");
	        });
	      });

	    </script>

	    <!-- -->
	    <script>
	      $(function() {
	        $('div.segmented-control a').on('click', function() {
	          $('div.segmented-control a').each(function(i, e) {
	            $(e).removeClass('active');
	          });
	          $(this).addClass('active');
	          $(this).find('input').prop('checked', true);
	          return false;
	        });
	      });

	    </script>

	    <script>
	      var ctr = 0;
	      $(document).ready(function() {
	        $("#result").children("tbody").children("tr").children("td").click(function() {
	          var isActive = $(this.parentNode).attr('class');
	          console.log(isActive);
	          if (isActive == "row-data")
	            ctr++;
	          else
	            ctr--;
	          $(this.parentNode).toggleClass("active");
	          console.log(ctr);
	          if (ctr == 1) {
	            $('#modifyButton').removeClass("disabled");
	            $('#removeButton').removeClass("disabled");
	            $('#makeupButton').removeClass("disabled");
	          } else {
	            $('#modifyButton').addClass("disabled");
	            $('#makeupButton').addClass("disabled");
	            if (ctr == 0) {
	              $('#removeButton').addClass("disabled");
	              $('#makeupButton').addClass("disabled");
	            } else
	              $('#removeButton').removeClass("disabled");
	          }
	        });
	      });

	    </script>

	    <script>
	      $("[rel='tooltip']").tooltip();
	      $('.thumbnail').hover(
	        function() {
	          $(this).find('.caption').slideDown(500); //.fadeIn(250)
	        },
	        function() {
	          $(this).find('.caption').slideUp(250); //.fadeOut(205)
	        }
	      );

	    </script>

	    <!-- SELECT PICKER -->
	    <script>
	      $(document).ready(function() {
	        $('.selectpicker').selectpicker({
	          style: 'btn-default',
	          size: false
	        });
	      });

	    </script>
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand navbar-brand-centered">FAMS</div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-brand-centered">

          <ul class="nav navbar-nav" style="padding:7px;">

            <li>

              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ayModal" id="dashay-button"><b>Current AY: 2016 - 2017 || Term 1<b></button>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html"><b>Log Out</b></a></li>
          </ul>

        </div>
     	<!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

		<div class = "container" style = "margin-top:-20px;">
			<div class = "im-centered-body">
				<br>
		   	</div>
					<div class="row">
						<div class = "col-md-6">
						<h4><b><?php echo strtoupper($faculty['last_name']. ", " .$faculty['first_name'] . " " . $faculty['middle_name']);?></b></h4>
						<h5><?php echo $faculty['id']?></h5>
						<h5><?php echo $faculty['department']; ?></h5>
						</div>
						<div class = "col-md-6">
							<div style = "float:right">
								<a href = "dashboard.php" data-toggle="modal" class="navbar-btn btn-success btn" style="margin-right:-13px">
			      					<span class="glyphicon glyphicon-chevron-left"></span> BACK </a> &nbsp;
							    <br>
						    </div>
						</div>
					</div>

					<div class = "row">
						<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel" style="float:right; margin-right: 15px;">
							<span class="glyphicon glyphicon-cog"></span> Filter Settings
				    </button>

						<div class="col-xs-3" style="float:right; margin-right: -75px;">
							<span id="pagelabel">1 - 15 of 200&nbsp;</span>
							<ul class="w3-pagination w3-border w3-margin-left">
							    <li><a href="#" class="w3-border-right">&#10094;</a></li>
							    <li><a href="#" >&#10095;</a></li>
							</ul>
						</div>
					</div>
			    <div class = "im-centered-body">
			    	<center>
              <div class = "container">
                <div class = "row">
                  <div id="filter-panel" class="collapse filter-panel" style = "width:85%;">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <form class="form-inline" id = "filter-form" role="form">
                          <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="class-type">Class Type:</label>
                            <select id = "class-type" class="form-control selectpicker show-tick" data-width = "100px">
                              <option value="normal" selected>Normal</option>
                              <option value="makeup">Make-Up</option>
                            </select>
                          </div> <!-- form group [rows] -->
                          <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="report-type">Daily Report Filter:</label>
                            <select id = "report-type" onchange = "change()" class="form-control selectpicker show-tick" data-width = "155px">
                              <option id ="dailyButton" value = "daily"> Daily </option>
                              <option value = "monthly"> Monthly </option>
                              <option value = "term"> Term-End </option>
							  <option value = "custom"> Custom </option>
                            </select>
                          </div>
                          <!-- form group [search] -->
                      <div class="form-group">
                        <div id="inputDaily">
                          <label class="filter-col" style="margin-right:;margin-top:5px" for="report-date">Date:
						                            <input id = "dailydate" style = "width:100px;margin-top:0px;margin-left:10px;" type="text" class="form-control" name="dailydate">
						                            </label>
                        </div>

                        <div id = "inputMonthly" style = "display:none;">
                          <label class="filter-col" style="margin-right:0;" for="report-date">Month:</label>
                          <select class="selectpicker show-tick" style="text-align:left;;" name="months" data-width="110px">
                            <option selected>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                          </select>

                          <select id="try" class="selectpicker show-tick" style="text-align:left;" name="years" data-width="100px">
                            <option selected>2016</option>
                            <option>2015</option>
                          </select>
                        </div>

                        <div id="inputTerm" style="display:none;">
                          <label class="filter-col" style="margin-right:0;" for="report-date">Date:</label>
                          <select class="selectpicker show-tick" style="text-align:left;" data-width="155px" name="academicyears">
														<option seleccted>A.Y. 2015-2016</option>
													</select>
                          <select class="selectpicker show-tick" style="text-align:left;" data-width="155px" name="terms">
														<option value = "1" selected>Term 1</option>
														<option value = "2">Term 2</option>
														<option value = "3">Term 3</option>

													</select>
                        </div>

                        <div id="inputCustom" style="display:none;">
                          <label class="filter-col" style="margin-right:0;margin-top:5px;" for="report-date">Date:</label>
                          <div id="reportrange" class="pull-right" style="width:230px">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret" style="float:right;margin-top:5px;"></b>
                          </div>

                        </div>

                      </div>
                          <!-- form group [order by] -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-success filter-col" style = "margin-left:10px;">
                              <span class="glyphicon glyphicon-record"></span> Apply
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div><!--end of filter container -->
              </div>
          </center>
			    <br>
				<div class="row">
							<div class ="box col-xs-12">
									<div class="box-content">
										<table id="result" class="table table-bordered table-condensed table-hover">
											<thead id="col-header">
												<tr>
													<th>Date</th>
													<th>Time</th>
													<th>Course</th>
													<th>Section</th>
													<th>Room</th>
													<th>Checker</th>
													<th>Remarks</th>
												</tr>
											</thead>
											<tbody>
                        <?php
                          foreach ($stmt as $row) {
                            echo "<tr class='row-data' data-href='#'>
                                    <td>".$row["date"]."</td>
                                    <td>".$row["time_start"]." - ".$row["time_end"]."</td>
                                    <td>".$row["course"]."</td>
                                    <td>".$row["section"]."</td>
                                    <td>".$row["room"]."</td>
                                    <td>".$row["checker"]."</td>
                                    <td>".$row["remarks"]."</td>
                                  </tr>";
                          }
                        ?>
											</tbody>
										</table>
										<table id="resultMakeUp" class="table table-bordered table-condensed table-hover">
											<thead id="col-header">
												<tr>
													<th>Date of Absence</th>
													<th>Course</th>
													<th>Section</th>
													<th>Date of Makeup</th>
													<th>Start Time</th>
													<th>End Time</th>
													<th>Reason</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
							</div>
				</div>

	    	</div>
    	</div>
	    <!-- SEARCH ATTENDANCE RECORDS MODAL -->
	    <div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="searchrecords-modal" role="dialog" style="display: none;" tabindex="-1">
	      <div class="modal-dialog">
	        <div class="addaymodal-container" id="searchrecords-container">
	          <form action="php/search-faculty.php" method="POST" class="form form-horizontal">
	            <fieldset>
	              <legend style="margin-bottom:-10px;"></legend>
	              <h3><legend class="text-center"><b>SEARCH ATTENDANCE RECORDS</b></legend></h3>
	              
	              <div class="form-group">
                	<label class="control-label col-xs-4" style="text-align:left;">Date:</label>
		              <div id="inputDaily" class="col-xs-8">
	                  	<input style="width:100px;margin-left:35px" type="text" class="form-control" id="dailydate" name="dailydate" />
	                  </div>
	              </div>


	              <div class="form-group">
	                <label class="control-label col-xs-5" style="text-align:left;"><input checked id="searchByID" name="option" type="radio" value="idNumber">&nbsp;&nbsp;by ID Number:</label>
	                <div class="col-xs-4">
	                  <input class="form-control" id="search-idnumber" name="idNumber" type="text" maxlength="8" style="width:80px;" onkeyup = "autocompletId()" autocomplete = "off">
	                  <ul id = "search-id-list"></ul>
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-xs-5" style="text-align:left;"><input id="searchByName" name="option" type="radio" value="name">&nbsp;&nbsp;by Name:</label>
	                <div class="col-xs-7">
	                  <input class="form-control" id="search-name" name="fullName" style="float: left; margin-right:5px;" type="text" placeholder="Last Name, First Name" onkeyup = "autocompletName()" autocomplete = "off" readonly>
	                    <ul id = "search-name-list"></ul>
	                </div>
	              </div><br>
	              <div class="text-center">
	                <button class="submit btn btn-success col-xs-3" style="margin-left:85px; margin-right:30px;" type="submit"><i class="glyphicon glyphicon-search"></i> SUBMIT</button> <button class="cancel btn btn-danger col-xs-3" data-dismiss="modal" type="button"><i class="glyphicon glyphicon-remove"></i> CANCEL</button>
	              </div>
	            </fieldset>
	          </form>
	        </div>
	      </div>
	    </div>
		</div> 
		<div class="navbar navbar-fixed-bottom">
    	<div class="container text-center">
    		<div class = "im-centered">
	          <a href="#" class="navbar-btn btn-success btn" data-toggle="modal" data-target="#addrecord-modal">
	            <span class="glyphicon glyphicon-plus"></span> ADD NEW RECORD </a>
	          <a id="modifyButton" class="navbar-btn btn-success btn disabled" data-toggle="modal" data-target="#modifymakeup-modal">
	            <span class="glyphicon glyphicon-pencil"></span> MODIFY </a>

	          <a id="removeButton" href="#" class="navbar-btn btn-success btn disabled" data-toggle="modal" data-target="#removerecord-modal">
	            <span class="glyphicon glyphicon-trash"></span> REMOVE </a>
	          <a href="#" id="makeupButton" class="navbar-btn btn-success btn disabled" data-toggle="modal" data-target="#addmakeup-modal">
	            <span class="glyphicon glyphicon-plus"></span> ADD NEW MAKE-UP CLASS </a>
    		</div>
   		</div>
		</div>
		<!-- ADD NEW RECORD MODAL -->
		<div class="modal fade" id="addrecord-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="addaymodal-container" id = "daily-container">
					<form class = "form form-horizontal" action="php/generate-daily.php" method="POST">
						<fieldset>
              <legend style = "margin-bottom:-10px;"></legend>
              <h3><legend class="text-center"><b>ADD NEW ATTENDANCE RECORD</b></legend></h3>

              <div class="form-group">
                <label class = "control-label col-xs-4" style = "text-align:left;">Faculty ID No:</label>
                <div class = "col-xs-8">
                  <input type="text" class="form-control" value = "<?php echo $faculty['id']?>" readonly/>
                </div>
              </div>

              <div class="form-group">
                <label class = "control-label col-xs-4" style = "text-align:left;">Faculty Name:</label>
                <div class = "col-xs-8">
                  <input type="text" class="form-control" value="<?php echo strtoupper($faculty['last_name']. ", " .$faculty['first_name']);?>" readonly/>
                </div>
              </div>

              <div class="form-group">
                <label class = "control-label col-xs-4" style = "text-align:left;">Absence Date:</label>
                <div class = "col-xs-8">
                  <input type="text" class="form-control" id="abscencedate" name="dailydate" value="10/31/2016"/>
                </div>
              </div>

              <div class="form-group">
                <label class = "control-label col-xs-4" style = "text-align:left;">Course & Section:</label>
                <div class = "col-xs-8">
                  <select class = "selectpicker show-tick" data-width = "180px">
                    <?php
                      echo $classes;
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-xs-5" style="text-align:left;">Checker:</label>
                <div class="col-xs-7" style="margin-left:-35px;">
                  <select class="selectpicker show-tick" data-width="180px">
                      <option selected>Ryan</option>
                      <option>Darren</option>
                      <option>Rhovic</option>
                      </select>
                </div>
              </div>

              <div class="form-group">
                <label class = "control-label col-xs-4" style = "text-align:left;">Remarks:</label>
                <div class = "col-xs-8">
                  <select class = "selectpicker show-tick" data-width = "180px">
                  <option selected>AB - Absent</option>
                  <option>LA - Late</option>
                  <option>SB - Substitute</option>
                  <option>VR - Vacant Room</option>
                  <option>ED - Early Dismissal</option>
                  <option>US - Unscheduled Class</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="text-center">
              	<button type="button" class="cancel btn btn-danger col-xs-3" style = "margin-left:85px; margin-right:30px;" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> CANCEL </button>
                <button type="submit" class="submit btn btn-success col-xs-3"> <i class = "glyphicon glyphicon-plus"></i> ADD </button>
              </div>
        	  </fieldset>
					</form>
				</div>
		  </div>
		</div>

		<!-- MODIFY ATTENDANCE RECORD MODAL -->
		<div class="modal fade" id="modifyrecord-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="addaymodal-container" id = "daily-container">
					<form class = "form form-horizontal" action="php/generate-daily.php" method="POST">
						<fieldset>
							 <legend style = "margin-bottom:-10px;"></legend>
			            	 <legend class="text-center"><h3><b>MODIFY ATTENDANCE RECORD</b></h3></legend>

			            	 <div class="form-group">
			            	 	<label class = "control-label col-xs-4" style = "text-align:left;">Faculty ID No:</label>
			            	 	<div class = "col-xs-8">
			            	 		<input type="text" class="form-control" value = "<?php echo $faculty['id']?>" maxlength="8" style ="width:80px;" readonly/>
			            	 	</div>
			            	 </div>

			            	 <div class="form-group">
			            	 	<label class = "control-label col-xs-4" style = "text-align:left;">Faculty Name:</label>
			            	 	<div class = "col-xs-8">
			            	 		<input type="text" class="form-control" value = "<?php echo strtoupper($faculty['last_name']. ", " .$faculty['first_name']);?>" readonly/>
			            	 	</div>
			            	 </div>

			            	 <div class="form-group">
			            	 	<label class = "control-label col-xs-4" style = "text-align:left;">Absence Date:</label>
			            	 	<div class = "col-xs-8">
			            	 		<input type="text" class="form-control" id="absencedate2" name="dailydate" value="10/31/2016"/>
			            	 	</div>
			            	 </div>

			            	 <div class="form-group">
				                <label class = "control-label col-xs-4" style = "text-align:left;">Course & Section:</label>
				                <div class = "col-xs-8">
				                  <select class = "selectpicker show-tick" data-width = "180px">
				                    <?php
				                      echo $classes;
				                    ?>
				                  </select>
				                </div>
				              </div>

			            	<div class="form-group">
				                <label class="control-label col-xs-5" style="text-align:left;">Checker:</label>
				                <div class="col-xs-7" style="margin-left:-35px;">
				                  <select class="selectpicker show-tick" data-width="180px">
				                      <option selected>Ryan</option>
				                      <option>Darren</option>
				                      <option>Rhovic</option>
				                      </select>
				                </div>
				              </div>

			            	<div class="form-group">
				                <label class="control-label col-xs-4" style="text-align:left;">Remarks:</label>
				                <div class="col-xs-8">
				                  <select class="selectpicker show-tick" data-width="180px">
				                        <option selected>AB - Absent</option>
				                        <option>LA - Late</option>
				                        <option>SB - Substitute</option>
				                        <option>VR - Vacant Room</option>
				                        <option>ED - Early Dismissal</option>
				                        <option>US - Unscheduled Class</option>
				                        </select>
				                </div>
				              </div>

							<br>
						    <div class="text-center">
						    	<button type="button" class="cancel btn btn-danger col-xs-3" style = "margin-left:85px; margin-right:30px;" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> CANCEL </button>
						        <button type="submit" class="submit btn btn-success col-xs-3"> <i class = "glyphicon glyphicon-floppy-saved"></i> SAVE </button>
						        
				            </div>

			        	</fieldset>
					</form>
				</div>
		  </div>
		</div>

		<!-- REMOVE RECORD MODAL -->
		<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="removerecord-modal" role="dialog" style="display: none;" tabindex="-1">
			<div class="modal-dialog">
				<div class="addaymodal-container" id="searchrecords-container">
					<form action="generatereports.php" class="form form-horizontal" method="post">
						<fieldset>
							<legend style = "margin-bottom:-10px;"></legend>
							<h3><legend class="text-center"><b>REMOVE ATTENDANCE RECORD</b></legend></h3>
							<div style = "font-weight:normal" class = "text-center">
								Are you sure to want to permanently delete the 3 selected attendance record/s?
							</div>
							<br><br>
							<div class="text-center">
								 <button class="cancel btn btn-danger col-xs-3" style="margin-left:85px; margin-right:30px;" data-dismiss="modal" type="button"><i class="glyphicon glyphicon-remove"></i> CANCEL</button>
								<button class="submit btn btn-success col-xs-3" type="submit"><i class="glyphicon glyphicon-trash"></i> REMOVE</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<!-- ADD MAKE UP CLASS MODAL -->
		<div class="modal fade" id="addmakeup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="makeupmodal-container" id = "makeup-container">
					<form class = "form form-horizontal" action="php/generate-daily.php" method="POST">
            <fieldset>
							<legend style = "margin-bottom:-10px;"></legend>
              <legend class="text-center"><h3><b>ADD MAKE UP CLASS</b></h3></legend>
              <div class="col-md-6">
                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Make Up Date:</label>
                  <div class = "col-xs-8">
                  <input type="text" class="form-control" id="makeupdate" name="dailydate" value="12/12/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Start Time:</label>
                  <div class = "col-xs-6">
                    <input class="form-control" name="starttime" id="starttime" type="time">
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">End Time:</label>
                  <div class = "col-xs-6">
                    <input class="form-control" name="endtime" id="endtime" type="time">
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Room:</label>
                  <div class = "col-xs-8">
                    <input id="section" type="text" class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Course & Section:</label>
                  <div class = "col-xs-8">
                  		<input id="section" type="text" class="form-control" value = "SOFENGG S18A" readonly/>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Absence Date:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control" id="absencedate-makeup" name="dailydate" value="11/30/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Reason for Absence:</label>
                  <div class = "col-xs-6" style = "text-align:left;">
                		<select class = "selectpicker tick-show" data-width = "120px">
                    <option selected>CF - Attended Conference</option>
                    <option>PM - Personal Matter</option>
                    <option>SI - Sickness</option>
                    <option>OB - Official Business</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Date Filed:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control" id="filed-date" name="dailydate" value="12/01/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Checker:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Class Made Up:</label>
                  <div class = "col-xs-8" style = "text-align:left;">
                    <form>
                    	<input type="radio" name="isMakeupDone" value="yes"><span> Yes</span>
                      <input type="radio" name="isMakeupDone" value="no" style ="margin-left: 10px;"><span> No</span>
                    </form>
                  </div>
                </div>
              </div>
              <br>
              <div class="text-center">
              	<button type="button" class="cancel btn btn-danger col-xs-3" style = "margin-left:85px; margin-right:30px;" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> CANCEL </button>
                <button type="submit" class="submit btn btn-success col-xs-3"> <i class = "glyphicon glyphicon-plus"></i> ADD </button>
              </div>
            </fieldset>
					</form>
				</div>
		  </div>
    </div>

    	<!-- MODIFY MAKE UP CLASS MODAL -->
		<div class="modal fade" id="modifymakeup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="makeupmodal-container" id = "makeup-container">
					<form class = "form form-horizontal" action="php/generate-daily.php" method="POST">
            <fieldset>
							<legend style = "margin-bottom:-10px;"></legend>
              <legend class="text-center"><h3><b>MODIFY MAKE UP CLASS</b></h3></legend>
              <div class="col-md-6">
                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Make Up Date:</label>
                  <div class = "col-xs-8">
                  <input type="text" class="form-control" id="makeupdate" name="dailydate" value="12/12/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Start Time:</label>
                  <div class = "col-xs-6">
                    <input class="form-control" name="starttime" id="starttime" type="time" value="11:00">
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">End Time:</label>
                  <div class = "col-xs-6">
                    <input class="form-control" name="endtime" id="endtime" type="time" value="12:30">
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Room:</label>
                  <div class = "col-xs-8">
                    <input id="section" type="text" class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Course & Section:</label>
                  <div class = "col-xs-8">
                  		<input id="section" type="text" class="form-control" value = "SOFENGG S18A" readonly/>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Absence Date:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control" id="absencedate-makeup" name="absencedate-makeup" value="11/30/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Reason for Absence:</label>
                  <div class = "col-xs-6" style = "text-align:left;">
                	<select class = "selectpicker tick-show" data-width = "120px">
	                    <option selected>CF - Attended Conference</option>
	                    <option>PM - Personal Matter</option>
	                    <option>SI - Sickness</option>
	                    <option>OB - Official Business</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Date Filed:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control" id="filed-date" name="dailydate" value="12/01/2016"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Checker:</label>
                  <div class = "col-xs-8">
                    <input type="text" class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class = "control-label col-xs-4" style = "text-align:left;">Class Made Up:</label>
                  <div class = "col-xs-8" style = "text-align:left;">
                    <form>
                    	<input type="radio" name="isMakeupDone" value="yes"><span> Yes</span>
                      <input type="radio" name="isMakeupDone" value="no" style ="margin-left: 10px;"><span> No</span>
                    </form>
                  </div>
                </div>
              </div>
              <br>
              <div class="text-center">
                <button type="submit" class="submit btn btn-success col-xs-3" style = "margin-left:85px; margin-right:30px;"> <i class = "glyphicon glyphicon-save"></i> SAVE </button>
                <button type="button" class="cancel btn btn-danger col-xs-3" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> CANCEL </button>
              </div>
            </fieldset>
					</form>
				</div>
		  </div>
    </div>
  </body>
</html>
