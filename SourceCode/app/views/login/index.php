<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    
    <!--[if lte IE 8]>
    <style type="text/css">
    .box {
        margin:50px 0px 0px 15% !important;  
		border: 1px solid #5F5440 !important;
    }
    </style>
    <![endif]--> 

    
    <!-- jquery -->
    <script src="<?php echo url()."/public/scripts/jquery/jquery.min.js"; ?>"></script> 
	
    <!-- boostrap-->
	<link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/bootstrap/bootstrap.min.css"; ?>">
    <script src="<?php echo url()."/public/scripts/bootstrap/bootstrap/bootstrap.min.js"; ?>"></script>   
    
    <style>                
        body {
            background-image: url('Res/amn/bg_repeat.png');            
        }
        .box {
            width:945px;
            height:400px;
            background:#FFF;
            margin:9% auto;
            padding:40px 0px 0px 0px !important;
            border-radius:3px;
        }
        .effect6 {
            position:relative;       
            -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
               -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
                    box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        }
        .effect6:before, .effect6:after {
            content:"";
            position:absolute; 
            z-index:-1;
            -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
            -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
            box-shadow:0 0 20px rgba(0,0,0,0.8);
            top:95%;
            bottom:0;
            left:10px;
            right:10px;
            -moz-border-radius:100px / 10px;
            border-radius:100px / 10px;
        }        
        #box_log input {
            width:250px;
        }  
        #box_log h3, #box_log strong {
            color:#254264;
        }         
        .verticalLine {
            border-left:1px solid #d2d6d7;
            height:320px;
            position:absolute;
            left:450px !important;
        }
        .clabel {
            font-size: 14px;
        }
        #welcome {
            font-size: 14px;
        }
        .alert {
            width: 358px;
            margin: -20px 0px 10px 0px;
            padding: 10px;
        }
        h3 {
            font-family: 'akashiregular';
            font-size: 22pt;
            color: #0E6390 !important;
        }
    </style>
</head>
<body>    

<div class="box effect6">
    <table style="width:100%;" id="box_log" border="0">
        <tr style="text-align: center">
            <td colspan="2"><h3>E Learning Collaborative System</h3></td>
        </tr>
        <tr>
            <td valign="top" style="width:50%;" style="text-align: center">
                <div class="text-center">
                    <h4>Sign Up</h4>
                </div>
                <form method="post" style="margin-left: 100px !important;" action="<?php echo url()."/register"; ?>" class="form-horizontal">
                    <input type="hidden" name="user_type" value="student" />
                    <input type="submit" class="btn show-tooltip" value="Student" />
                </form>
                <form method="post" style="margin-left: 100px !important;" action="<?php echo url()."/register"; ?>" class="form-horizontal">
                    <input type="hidden" name="user_type" value="instructor" />
                    <input type="submit" class="btn show-tooltip" value="Instructor" />
                </form>
            </td>
            <td valign="top">
                <div class="verticalLine"></div>
                <p id="welcome">Please login using your existing username and password.</p>
                <br/>
                <?php echo $errors; ?>
                <form method="post" action="<?php echo url()."/login"; ?>" class="form-horizontal">
                <div class="form-group">
                    <label class="clabel">Username</label>
                    <input type="text" id="username" name="username" class="form-control input-sm" type="text"/>
                </div>
                <div class="form-group">
                    <label class="clabel">Password</label>
                    <input type="password" name="password" class="form-control input-sm" type="text"/>
                </div>
                <br />
                <div class="form-group">                    
                    <input type="submit" class="btn show-tooltip" value="Login" />
                </div>
                </form>
            </td>
            
        </tr>
    </table>
</div>  
    
</body>
</html>