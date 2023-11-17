
<?php

require_once('./app/controller/config.php');
require_once('./app/controller/functions_db.php');

if (isset($_POST['isChecked']) && isset($_POST['dataId'])) {
    $isChecked = $_POST['isChecked'];
    $dataId = $_POST['dataId'];

    if ($isChecked) {
        echo "like";
    }

    echo 'Ação concluída com sucesso';
} else {
}
?>


<!DOCTYPE html>
<html>
<head>
    <style>
        .custom-icon {
            color: black; 
            transition: color 0.3s; 
            cursor: pointer;
        }
        
        .custom-checkbox:checked + .custom-icon {
            color: #a200ff; 
        } 

        .custom-checkbox {
            display: none;
        }

        @keyframes moveArrow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px); 
            }
        }

        .custom-checkbox:checked + .custom-icon {
            animation: moveArrow 1s ease-in-out; 
        }
    </style>
</head>
<body>

<label class="checkbox-container">
    <input type="checkbox" class="custom-checkbox">
    <i class="custom-icon fas fa-arrow-up"></i>
</label>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    const checkbox = document.querySelector('.custom-checkbox');
    const icon = document.querySelector('.custom-icon');

    icon.addEventListener('click', () => {
        checkbox.checked = !checkbox.checked;
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./app/ajax/like.js"></script>
</body>
</html>
