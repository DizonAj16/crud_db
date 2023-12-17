<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $display = $ram = $rom = $processor = "";
$name_err = $display_err = $ram_err = $rom_err = $processor_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter an name.";     
    } else{
        $name = $input_name;
    }
    
    // Validate display
    $input_display = trim($_POST["display"]);
    if(empty($input_display)){
        $display_err = "Please enter an display.";     
    } else{
        $display = $input_display;
    }
    
    // Validate ram
    $input_ram = trim($_POST["ram"]);
    if(empty($input_ram)){
        $ram_err = "Please enter an ram.";     
    } else{
        $ram = $input_ram;
    }

    // Validate rom
    $input_rom = trim($_POST["rom"]);
    if(empty($input_rom)){
        $rom_err = "Please enter an storage.";     
    } else{
        $rom = $input_rom;
    }
    
    // Validate processor
    $input_processor = trim($_POST["processor"]);
    if(empty($input_processor)){
        $processor_err = "Please enter an processor.";     
    } else{
        $processor = $input_processor;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($display_err) && empty($ram_err) && empty($rom_err) && empty($processor_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO smartphones (name, display, ram, rom, processor ) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_display, $param_ram, $param_rom, $param_processor);
            
            // Set parameters
            $param_name = $name;
            $param_display = $display;
            $param_ram = $ram;
            $param_rom = $rom;
            $param_processor = $processor;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Display</label>
                            <textarea name="display" class="form-control <?php echo (!empty($display_err)) ? 'is-invalid' : ''; ?>"><?php echo $display; ?></textarea>
                            <span class="invalid-feedback"><?php echo $display_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Ram</label>
                            <input type="text" name="ram" class="form-control <?php echo (!empty($ram_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ram; ?>">
                            <span class="invalid-feedback"><?php echo $ram_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Rom</label>
                            <input type="text" name="rom" class="form-control <?php echo (!empty($rom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rom; ?>">
                            <span class="invalid-feedback"><?php echo $rom_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Processor</label>
                            <input type="text" name="processor" class="form-control <?php echo (!empty($processor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $processor; ?>">
                            <span class="invalid-feedback"><?php echo $processor_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>