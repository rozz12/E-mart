<?php
    session_start();
    include('connection.php');
    $errors = [];
    if (!isset($_POST['add_button'])) {
        header('Location:TraderUI.php');
    }
    else{
         $shop_name = filter_var(trim($_POST['shopName']),FILTER_SANITIZE_STRING);
        $est_date = $_POST['estDate'];
        $shop_type = $_POST['shopType'];

        if(empty($shop_name))
        {
            $errors['shopName'] = "Shop name can not be empty";
        }

        if(gettype($shop_name)!='string')
        {
            $errors['shopName'] = "Shop name must be alphabetical";
        }

        if(empty($est_date))
        {
            $errors['estDate'] = "Established date can not be empty";
        }

        if(empty($shop_type))
        {
            $errors['shopType'] = "Shop type can not be empty";
        }

        //counting the number of errors
        if (count($errors)>=1) {
            header('Location: TraderUI.php?errors=.'$errors);
        }
        else{
            $qry = "SELECT shoptype_id FROM Shop_type WHERE shop_type=".$shop_type;
            $prs=oci_parse($conn, $qry);
            oci_execute($prs);
            $row = oci_fetch_assoc($prs);
            oci_free_statement($ins_prs);

            $insert = "INSERT INTO SHOP (Shop_name,established_date,Shoptype_id) VALUES(:shop_name,:estd_date,:sid)";
            $ins_prs = oci_parse($conn, $insert);
            oci_bind_by_name($ins_prs, ':shop_name', $shop_name);
            oci_bind_by_name($ins_prs, ':estd_date', $est_date);
            oci_bind_by_name($ins_prs, ':sid', $row['SHOPTYPE_ID']);
            oci_execute($ins_prs);
            oci_free_statement($ins_prs);
            
            $errors = 'Shop Added Sucesfully.'
            header('Location: TraderUI.php?errors=.'$errors);

        }
    }
   

?>

