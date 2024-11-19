<?php
spl_autoload_register(function ($className) {
    // Define the base directory for your models
    $baseDir = __DIR__ . '/../modals/'; // Update this path as necessary

    // Create the full path to the class file
    $file = $baseDir . $className . '.class.php'; // Assuming your files are named with .class.php

    // Check if the file exists
    if (file_exists($file)) {
        require_once $file; // Include the class file
    } else {
        // Optional: Log an error or throw an exception
        error_log("File not found: " . $file);
    }
});


  $project = new Project();
  $project->tableName = "tbl_project";

  $admin = new Admin();
  $admin->tableName = "tbl_admin";

  $skill = new Skill();
  $skill->tableName = "tbl_skill";
