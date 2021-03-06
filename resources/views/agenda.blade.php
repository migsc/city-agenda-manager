<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>City Agenga Meeting Manager</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="dist/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <div id="loading-screen"><img src="img/spin.gif"></div>
        <button id="add-meeting-button" type="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-plus"></i></button>
        <button id="save-meeting-button" style="display: none;" type="button" class="btn btn-success btn-circle btn-xl"><i class="fa fa-floppy-o"></i></button>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">City Meeting Agenda Manager</a>
            </div>
            <!-- /.navbar-header -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Meetings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

              <div class="col-lg-12 col-md-12">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-comments fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                  <div id="selected-title" class="huge"></div>
                                  <div>This item is currently being dicussed.</div>
                              </div>
                          </div>
                      </div>
                      <a href="#">
                          <div class="panel-footer">
                              <span class="pull-left">Edit</span>
                              <span class="pull-right"><i class="fa fa-pencil"></i></span>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>


                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="meetings-table"></tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- App API Library -->
    <script src="js/api.js"></script>

    <!-- HTML Templates -->

    <script id="meeting-row-template" type="text/template">

      <tr class="{parity} gradeX" data-index="{index}">
          <td>{title}</td>
          <td>
            {statusDropdown}
          </td>
          <td><button type="button" class="btn btn-primary meeting-select-button">Discuss</button></td>
      </tr>
    </script>

    <script id="status-dropdown-template" type="text/template">
      <select class="status-dropdown form-control">
        <option value="" disabled selected>Select Status</option>
        {statusOptions}
      </select>
    </script>

    <script id="status-option-template" type="text/template">
      <option value="{statusValue}" {statusSelected}>{statusDisplayText}</option>
    </script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">
        var meetings = [],
            meetingStatuses = [];

        $(document).ready(function() {

          var meetingsTable = $("#meetings-table"),
              meetingRowTemplate = $("#meeting-row-template").html(),
              selectedMeetingTitle = $("#selected-title"),
              addMeetingButton = $("#add-meeting-button"),
              saveMeetingButton = $("#save-meeting-button"),
              loadingScreen = $("#loading-screen");

          loadingScreen.show();

          var getLastMeetingRow = function(){
              return meetingsTable.find("> tr:last-child");
          };

          var meetingRowSelectHandler = function(e){
              var iMeetingSelected = $(e.target).parent().parent().data('index'),
                  meetingSelected = meetings[iMeetingSelected];

              renderCurrentMeeting(selectedMeetingTitle, meetingSelected);
              loadingScreen.show();
              api.updateCurrentMeeting(meetingSelected).then(function(){
                loadingScreen.hide();
              });
          };

          var statusDropdownSelectHandler = function(e){
              var iMeetingSelected = $(e.target).parent().parent().data('index');

              loadingScreen.show();
              updateMeetingFromDOM(iMeetingSelected, null, $(e.target)).then(function(){
                loadingScreen.hide();
              });
          };

          var getRenderedMeetingStatusDropdown = function(meeting){
              var statusDropdownTemplate = $("#status-dropdown-template").html(),
                  statusOptionTemplate = $("#status-option-template").html();

              return statusDropdownTemplate.replace('{statusOptions}', meetingStatuses.map(function(status){
                  return statusOptionTemplate
                    .replace('{statusValue}', status)
                    .replace('{statusSelected}', status === meeting.status ? "selected" : "")
                    .replace('{statusDisplayText}',
                        status.split(' ').map(function(statusWord){
                            return statusWord.charAt(0).toUpperCase() + statusWord.slice(1).toLowerCase();
                        }).join(' ')
                    );
              }));
          };

          var renderMeetings = function (tableElement, rowTemplate, meetingObjs){
              tableElement.html(meetingObjs.map(function(meeting, index){
                return rowTemplate
                  .replace('{parity}', index % 2 === 0 ? 'even' : 'odd')
                  .replace('{title}', meeting.title)
                  .replace('{statusDropdown}', getRenderedMeetingStatusDropdown(meeting))
                  .replace('{index}', index)
              }));

              $('.meeting-select-button').click(meetingRowSelectHandler);
              $('.status-dropdown').change(statusDropdownSelectHandler);
          };

          var renderCurrentMeeting = function(titleElement, meetingObj){
              titleElement.html(meetingObj.title);
          };

          var updateMeetingFromDOM = function(meetingID, titleElement, statusElement){
            if(titleElement){
              meetings[meetingID].title = titleElement.text();
            }

            if(statusElement){
              meetings[meetingID].status = statusElement.val();
            }

            return api.updateMeetings(meetings);
          }

          addMeetingButton.click(function(e){
            var lastMeetingRow,
                lastMeetingRowTitleElement;

            addMeetingButton.hide();
            saveMeetingButton.show();

            // Create a new row and render it
            meetings.push({
              id: meetings.length + 1,
              status: '',
              title: ''
            });
            renderMeetings(meetingsTable, meetingRowTemplate, meetings);

            // Scroll to the bottom
            $('html, body').animate({
                scrollTop: $(document).height()
            }, 'slow');

            // Edit the row
            lastMeetingRow = getLastMeetingRow();
            lastMeetingRowTitleElement = lastMeetingRow.find("> td:first-child");
            lastMeetingRowTitleElement
              .attr('contenteditable', true)
              .focus()
              .on('blur', function(){
                loadingScreen.show();
                updateMeetingFromDOM(meetings.length - 1, $(this), null).then(function(){
                  saveMeetingButton.hide();
                  addMeetingButton.show();
                  loadingScreen.hide();
                })
              });
          });

          saveMeetingButton.click(function(e){
            var lastMeetingRowTitleElement = getLastMeetingRow().find("> td:first-child");
            loadingScreen.show();
            updateMeetingFromDOM(meetings.length - 1, lastMeetingRowTitleElement, null).then(function(){
              saveMeetingButton.hide();
              addMeetingButton.show();
              loadingScreen.hide();
            })
          });

          // Initialize
          $('#dataTables-example').DataTable({
              responsive: true,
              searching: false,
              paging: false,
              columns: [
                  { "width": "80%" }
              ]
          });

          api.getConfig().then(function(response){
              meetingStatuses = response.statuses;
              return api.getMeetings();
          }).then(function(response){
              meetings = response;
              renderMeetings(meetingsTable, meetingRowTemplate, response);
              return api.getCurrentMeeting();
          }).then(function(response){
              renderCurrentMeeting(selectedMeetingTitle, response);
              loadingScreen.hide();
          });
        });
    </script>

</body>

</html>
