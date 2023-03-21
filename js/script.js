$(function () {
  function check() {
    let selectedCells = [];
    $("td[data-id]").click(function () {
      const index = $(this).data("id") - 1;
      if (selectedCells.length < 2 && !selectedCells.includes(index)) {
        selectedCells.push(index);
        $(this).addClass("selected");
      } else if (selectedCells.includes(index)) {
        selectedCells.splice(selectedCells.indexOf(index), 1);
        $(this).removeClass("selected");
      }
    });
    $("#checkit").click(function () {
      if (selectedCells.length === 2) {
        const row1 = Math.floor(selectedCells[0] / 2);
        const col1 = selectedCells[0] % 2;
        const row2 = Math.floor(selectedCells[1] / 2);
        const col2 = selectedCells[1] % 2;
        if (
          (row1 === row2 && Math.abs(col1 - col2) === 1) ||
          (col1 === col2 && Math.abs(row1 - row2) === 1)
        ) {
          alert("登入成功");
          window.location.href = "index.php";
        } else {
          alert("二次驗證錯誤");
          window.location.href = "logout.php";
        }
      }
    });
  }
  check();
  let timeleft = 60;
  let timer, confirmTimer, counter;
  const startConfirmTimer = () => {
    confirmTimer = setTimeout(() => {
      let count = 4;
      counter = setInterval(() => {
        $("#countdownModal").text(count--);
        if (count < 0) {
          window.location.href = "logout.php";
          clearInterval(counter);
        }
      }, 1000);
    }, 1000);
  };

  const stopConfirmTimer = () => {
    clearTimeout(confirmTimer);
  };

  const startTimer = () => {
    clearInterval(timer);
    timer = setInterval(() => {
      $("#countdown").html(`${timeleft--} 秒`);
      if (timeleft < 0) {
        clearInterval(timer);
        $("#confirmModal").modal("show");
        startConfirmTimer();
      }
    }, 1000);
  };

  const resetConfirmTimer = () => {
    stopConfirmTimer();
    $("#confirmModal").modal("hide");
    timeleft = parseInt($("#timeInput").val());
    startTimer();
  };

  const setTime = () => {
    timeleft = parseInt($("#timeInput").val());
    startTimer();
  };

  const resetTime = () => {
    clearInterval(timer);
    timeleft = parseInt($("#timeInput").val());
    startTimer();
  };

  $("#setTimeBtn").on("click", setTime);
  $("#resetTimeBtn").on("click", resetTime);

  $("#timerModal").on("show.bs.modal", () => {
    clearInterval(timer);
    setTime();
  });

  $("#timerModal").on("hide.bs.modal", () => clearInterval(timer));

  $("#continueBtn").on("click", () => {
    stopConfirmTimer();
    resetConfirmTimer();
    $("#confirmModal").modal("hide");
    resetTime();
    clearInterval(counter);
    clearTimeout(confirmTimer);
  });

  $("#cancelBtn").on("click", () => {
    window.location.href = "logout.php";
  });
  $("#confirmModal").on("hidden.bs.modal", () => {
    $("#countdownModal").text(5);
  });
  setTime();

  $(".getmember").click(function () {
    let member_id = $(this).data("id");
    $.ajax({
      url: "get_member.php",
      type: "GET",
      data: {
        id: member_id,
      },
      dataType: "json",
      success: function (response) {
        $("#user").val(response[0].user);
        $("#user_name").val(response[0].user_name);
        $("#pw").val(response[0].pw);
        $("#id").val(response[0].id);
        $("#edit").modal("show");
      },
    });
  });

  $(".savemember").click(function () {
    let user = $("#user").val();
    let user_name = $("#user_name").val();
    let pw = $("#pw").val();
    let id = $("#id").val();

    let data = {
      user: user,
      user_name: user_name,
      pw: pw,
      id: id,
    };
    $.ajax({
      url: "save_member.php",
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        window.location.reload();
      },
    });
  });

  $(".getproduct").click(function () {
    let product_id = $(this).data("id");
    $.ajax({
      url: "get_product.php",
      type: "GET",
      data: {
        id: product_id,
      },
      dataType: "json",
      success: function (response) {
        $("#id").val(response[0].id);
        $("#product_name").val(response[0].product_name);
        $("#product_des").val(response[0].product_des);
        $("#price").val(response[0].price);
        $("#links").val(response[0].links);
        let imagePath = "./images/" + response[0].images;
        $("#current-image").attr("src", imagePath);
      },
    });
  });

  $(".saveproduct").click(function (e) {
    e.preventDefault();
    let formData = new FormData();
    formData.append("id", $("#id").val());
    formData.append("product_name", $("#product_name").val());
    formData.append("product_des", $("#product_des").val());
    formData.append("price", $("#price").val());
    formData.append("links", $("#links").val());
    formData.append("images", $("#images")[0].files[0]);
    $.ajax({
      url: "update_product.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        window.location.reload();
      },
    });
  });
  $("#search-member").submit(function (e) {
    e.preventDefault();
    let search = $("#search-input").val();
    let use = $('input[name="use"]:checked').val();
    $.ajax({
      url: "search_member.php",
      type: "post",
      data: {
        search: search,
        use: use,
      },
      success: function (response) {
        console.log(response);
        $("#search_result").html(response);
        $(".show-all").addClass("d-none");
      },
    });
  });

  $("#search-product").submit(function (e) {
    e.preventDefault();
    let search = $("#search-input").val();
    let minPrice = $("#min-price-input").val();
    let maxPrice = $("#max-price-input").val();

    $.ajax({
      url: "search_product.php",
      type: "post",
      data: {
        search: search,
        min_price: minPrice,
        max_price: maxPrice,
      },
      success: function (response) {
        console.log(response);
        let search_res = $("#search-results");
        search_res.html(response);
        if (search_res.children().length == 0) {
          search_res.append(
            "<div class='d-center text-center text-white h1'>查無資料</div>"
          );
          setTimeout(function () {
            window.location.reload();
          }, 2500);
        }
      },
    });
  });
});
