<?php
require("./services/BD.php");
function ValidateEmail($email)
{
  $Response = [
    "IsFine" => true,
    "MsgError" => "ERROR"
  ];

  $emailtrim = trim($email); //? Eliminar espacios al inicio y final del string
  //? Validar que el email tenga texo
  if ($emailtrim == "" or $emailtrim == null) {
    $Response = [
      "IsFine" => false,
      "MsgError" => "Email Vacio"
    ];
    return $Response;
  }
  //? Validacion del tipo de dato
  if (gettype($email) != "string") {
    $Response = [
      "IsFine" => false,
      "MsgError" => "Tipo de dato invalido"
    ];
    return $Response;
  }

  return $Response;
}
function ValidateEmailAndPass($email, $pass)
{
  $SQLQuery = "SELECT * from users WHERE email = '" . $email . "'";
  if (ValidateExistence($SQLQuery) == true) {
    $SQLData = GetData($SQLQuery);

    if ($SQLData["password"] == $pass) {
      return true;
    } else
      return false;
  }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //? lee la información del tipo Json
  $json = file_get_contents('php://input');
  //? Convierte el Json a un array asociativo
  $data = json_decode($json);
  // print_r($data); // Imprimir Data (Dev)

  //? Validación del Body
  if (isset($data->email) and isset($data->pass)) {
    // ? Validacion del string de email
    $ValideEmail = ValidateEmail($data->email);
    if ($ValideEmail["IsFine"] == true) {
      $Result = [
        "IsFine" => false,
        "ErrMsg" => ""
      ];
      //? Validacion  Final con la Base de Datos
      $FinalValidation = ValidateEmailAndPass($data->email, $data->pass);
      if ($FinalValidation == true) {
        $Result = [
          "IsFine" => true,
          "ErrMsg" => "Crecenciales Correctas"
        ];

      } else {
        $Result = [
          "IsFine" => false,
          "ErrMsg" => "Correo o Contraseña Incorrectos"
        ];
      }
      echo json_encode($Result);
    } else {
      $Result = [
        "IsFine" => false,
        "ErrMsg" => "Correo Invalido"
      ];
      echo json_encode($Result);
    }
  } else {
    echo "Bad Body";
  }
  //? Validar que se pasaron los parámetros
} else {
  echo "Fail Request";
}