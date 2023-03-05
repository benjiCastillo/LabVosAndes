var PATH = "http://localhost/LabVosAndes/api/";

function encodeQueryData(data) {
    const ret = [];
    for (let d in data) {
        if (data[d] !== null)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
    }
    return ret.join('&');
}