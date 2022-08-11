var matengmap = document.getElementById("mateng-map"),
    kecamatanInfo = document.getElementById("kecamatanInfo"),
    allProvinces = matengmap.querySelectorAll("g");
matengmap.addEventListener("click", function (e) {
    var kecamatan = e.target.parentNode;
    if (e.target.nodeName == "path") {
        for (var i = 0; i < allProvinces.length; i++) {
            allProvinces[i].classList.remove("active");
        }
        kecamatan.classList.add("active");
        var kecamatanName = kecamatan.querySelector("title").innerHTML,
            harga = kecamatan.querySelector("desc p"),
            status = kecamatan.querySelector("desc status"),
            selisih = kecamatan.querySelector("desc small");
        (sourceImg = kecamatan.querySelector("img")),
            (kecamatanInfo.innerHTML = "");

        var statusAlert = "";
        var iconStatus = "";

        switch (status.innerHTML) {
            case "NAIK":
                statusAlert = "alert-danger";
                iconStatus = "fa-arrow-up";
                break;
            case "TURUN":
                statusAlert = "alert-success";
                iconStatus = "fa-arrow-down";
                break;
            case "STABIL":
                statusAlert = "alert-primary";
                iconStatus = "fa-circle";
                break;
        }

        kecamatanInfo.insertAdjacentHTML(
            "afterbegin",
            // "<img src=" +
            //     sourceImg.getAttribute("xlink:href") +
            //     " alt='" +
            //     sourceImg.getAttribute("alt") +
            "<h6 class='text-success'>" +
                kecamatanName +
                "</h6><b>" +
                harga.innerHTML +
                "</b>" +
                "<div class='alert " +
                statusAlert +
                "'><i class='fas " +
                iconStatus +
                "'></i> <small>" +
                status.innerHTML +
                "</small><br>" +
                selisih.innerHTML +
                "</div>"
        );
        kecamatanInfo.classList.add("show");
    }
});
