function createExhibitions(n) {
    var exhibitionTemplate = {
        id: 0,
        name: "",
        shortDescr: "",
        longDescr: "",
        startDate: "2016-05-13 20:00:00",
        endDate: "2016-06-13 23:59:59"
    };

    var result = [];

    for (i = 1; i < n + 1; i++) {
        
        var x = $.parseJSON(JSON.stringify(exhibitionTemplate));
        x.id = i;
        x.name = "utstillinger" + i;
        x.shortDescr = "utstillinger" + i + ".kort beskrivelse";
        x.longDescr = "utstillinger" + i + ".lang beskrivelse";
        result.push(x);
    }
    return result;
}

function createPictures(n) {
    var pictureTemplate = {
        id: 0,
        name: "",
        shortDescr: "",
        longDescr: "",
        path: ""
    };
    var result = [];
    for (i = 1; i < n+1; i++) {
        var p = $.parseJSON(JSON.stringify(pictureTemplate));
        p.id = i;
        p.name = "picture" + i;
        p.shortDescr = "picture" + i + ".kort beskrivelse";
        p.longDescr = "picture" + i + ".lang beskrivelse";
        p.path = "/pictures/picture" + i + ".jpg";
        result.push(p);
    }
    return result;
}

function findObject(id, objArray) {
    for (i = 0; i < objArray.length; i++) {
        if (objArray[i].id == id) return objArray[i];
    }
    return undefined;
}

function assignPicture2Exhibition(pictureId, exhibitionId, picExhArray) {
    var entry = [exhibitionId,pictureId];
    picExhArray.push(entry);
}

function getPictures(exhibitionId,picExhArray,picArray) {
    var result = [];

    if (picExhArray.length == 0 || picArray.length == 0) return result;
    
    for (var i = 0; i < picExhArray.length; i++) {
        if (picExhArray[i][0] == exhibitionId) {
            var p = findObject(picExhArray[i][1], picArray);
            result.push(p);
        }
    }
    return result;
}

function createPictureExhibition(nPic, exhibitionId, picArray) {
    var result = [];
    for (var i = 0; i < nPic; i++) {
        var last_r =-1;
        var r = -1;
        while (r == last_r) {
            r = Math.floor((Math.random() * picArray.length)); //ensure a diffent random number
        }
        var picture = picArray[r];
        assignPicture2Exhibition(picture.id, exhibitionId, result);
        last_r = r;
    }
    return result;
}

function set_section(pageRef) {
    if (pageRef === undefined) return;
    if (pageRef.indexOf("#") < 0) return;
    $("section.ui_page.active").hide();
    $("section.ui_page.active").removeClass("active");
    $("section.ui_page" + pageRef).addClass("active");
    $("section.ui_page" + pageRef).show();
}
