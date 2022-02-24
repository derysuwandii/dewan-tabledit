<?php include 'koneksi.php'; ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>Live Table Edit - Dewan Komputer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.min.js"></script>
    <style type="text/css">
      @media 
      only screen and (max-width: 760px),
      (min-device-width: 768px) and (max-device-width: 1024px)  {

        table, thead, tbody, th, td, tr { 
          display: block; 
        }
        
        thead tr { 
          position: absolute;
          top: -9999px;
          left: -9999px;
        }
        
        tr { border: 1px solid #ccc; }
        
        td { 
          border: none;
          border-bottom: 1px solid #eee; 
          position: relative;
          padding-left: 50% !important; 
        }
        
        td:before { 
          position: absolute;
          top: 6px;
          left: 6px;
          width: 45%; 
          padding-right: 10px; 
          white-space: nowrap;
        }

        td:nth-of-type(1):before { content: "ID"; }
        td:nth-of-type(2):before { content: "Nama Lengkap"; }
        td:nth-of-type(3):before { content: "Alamat"; }
        td:nth-of-type(4):before { content: "Jenkel"; }
        td:nth-of-type(5):before { content: "Jabatan"; }
        td:nth-of-type(6):before { content: "Umur"; }
        td:nth-of-type(7):before { content: "Action"; }
      }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" style="color: #fff;" href="index.php">
      Dewan Komputer
    </a>
  </nav>

  <div class="container">  
    <div class="">  
      <h3 align="center">Live Table Data Edit Delete using Tabledit Plugin in PHP</h3><br />  
      <table id="editable_table" class="table table-bordered table-striped">
         <thead>
            <tr>
             <th>ID</th>
             <th>Nama Lengkap</th>
             <th>Alamat</th>
             <th>Jenkel</th>
             <th>Jabatan</th>
             <th>Umur</th>
            </tr>
         </thead>
         <tbody>
            <?php
              $query = "SELECT * FROM tbl_karyawan ORDER BY id ASC";
              $dewan1 = $db1->prepare($query);
              $dewan1->execute();
              $res1 = $dewan1->get_result();
              while ($row = $res1->fetch_assoc()) {
                echo '
                <tr>
                 <td>'.$row["id"].'</td>
                 <td>'.$row["nama_lengkap"].'</td>
                 <td>'.$row["alamat"].'</td>
                 <td>'.$row["jenkel"].'</td>
                 <td>'.$row["jabatan"].'</td>
                 <td>'.$row["umur"].'</td>
                </tr>
                ';
             }
            ?>
         </tbody>
      </table>
    </div>  
  </div>

  <script>  
    $(document).ready(function(){  
      $('#editable_table').Tabledit({
        url:'action.php',
        columns:{
          identifier:[0, "id"],
          editable:[[1, 'nama_lengkap'], [2, 'alamat'], [3, 'jenkel'], [4, 'jabatan'], [5, 'umur']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.id).remove();
          }
        }
      });
    });
  </script>
 </body>
</html>