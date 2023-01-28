const index = () => {
  const handleSumbitForm = async (e) => {
    e.preventDefault();
    console.log("handleSumbitForm");

    const RefEmailInput = document.getElementById("EmailInput");
    const RefPassInput = document.getElementById("PassInput");

    const EmailValue = RefEmailInput.value;
    const PassValue = RefPassInput.value;

    const ResAPI = await GetValidation(EmailValue, PassValue);
    if (ResAPI.IsFine) {
      window.localStorage.setItem("Authenticated", true);
      console.log("AUTENTICADO");
      location.href = "http://localhost/login/home";
    } else {
      window.localStorage.setItem("Authenticated", false);

      const RefErrorDev = document.getElementById("errorDiv");
      RefErrorDev.innerHTML = ResAPI.ErrMsg;
      RefErrorDev.style.display = "block";
    }
  };

  const GetValidation = async (email, pass) => {
    const JsonBody = {
      email,
      pass,
    };
    const Res = await fetch("http://localhost/login/api.php", {
      method: "POST",
      body: JSON.stringify(JsonBody),
    });
    const ResJson = await Res.json();
    return ResJson;
  };

  const RefForm = document.getElementById("LoginForm");
  RefForm.addEventListener("submit", handleSumbitForm);
};

window.addEventListener("load", index);
