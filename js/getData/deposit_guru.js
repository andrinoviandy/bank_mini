async function hitungBaris(keyword) {
    let jmll = 0;
    const page = getVars("page").replace('#', '');
    if (keyword == '') {
        if (tgl1 === undefined && tgl2 === undefined) {
            await $.get("json/" + page + ".php?status=" + status_deposit_guru,
                function (data) {
                    jmll = data;
                }
            );
        } else {
            await $.get("json/" + page + ".php?tgl1=" + tgl1 + "&tgl2=" + tgl2 + "&status=" + status_deposit_guru,
                function (data) {
                    jmll = data;
                }
            );
        }
    } else {
        if (tgl1 === undefined && tgl2 === undefined) {
            await $.get("json/" + page + ".php?cari=" + keyword + "&status=" + status_deposit_guru,
                function (data) {
                    jmll = data;
                }
            );
        } else {
            await $.get("json/" + page + ".php?cari=" + keyword + "&tgl1=" + tgl1 + "&tgl2=" + tgl2 + "&status=" + status_deposit_guru,
                function (data) {
                    jmll = data;
                }
            );
        }
    }
    jumlah_total = jmll;
}

async function loadMore(start, keyword) {
    await hitungBaris(keyword)
    const page = getVars("page").replace('#', '');
    // console.log('tgl1', tgl1);
    // console.log('tgl2', tgl2);
    if (keyword == '') {
        if (tgl1 === undefined && tgl2 === undefined) {
            console.log('test1');
            $.get("data/" + page + ".php?start=" + start + "&page=" + page + "&status=" + status_deposit_guru,
                function (data) {
                    $('#table').html(data);
                }
            );
        } else {
            console.log('test2');
            $.get("data/" + page + ".php?start=" + start + "&page=" + page + "&status=" + status_deposit_guru + "&tgl1=" + tgl1 + "&tgl2=" + tgl2,
                function (data) {
                    $('#table').html(data);
                }
            );
        }
    } else {
        if (tgl1 === undefined && tgl2 === undefined) {
            console.log('test3');
            $.get("data/" + page + ".php?start=" + start + "&page=" + page + "&cari=" + keyword + "&status=" + status_deposit_guru,
                function (data) {
                    $('#table').html(data);
                }
            );
        } else {
            console.log('test4');
            $.get("data/" + page + ".php?start=" + start + "&page=" + page + "&cari=" + keyword + "&status=" + status_deposit_guru + "&tgl1=" + tgl1 + "&tgl2=" + tgl2,
                function (data) {
                    $('#table').html(data);
                }
            );
        }
    }
    cekPaging(start)
    if (jumlah_total <= jumlah_limit) {
        dari.innerText = 1
        sampai.innerText = jumlah_total
    } else {
        if (start == 0) {
            dari.innerText = 1
            sampai.innerText = jumlah_limit
        }
        else {
            if (jumlah_total - start < jumlah_limit) {
                dari.innerText = start + 1
                sampai.innerText = jumlah_total
            } else {
                dari.innerText = start + 1
                sampai.innerText = start + jumlah_limit
            }
        }
    }
}