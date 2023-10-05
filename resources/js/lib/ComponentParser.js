export function getComponentList(a) {
    const dat = [];
    for (let y in a.config) {
        if (a.config[y].text == "Content") {
            // console.log("GET THE ARRAY");
            return a.config[y].value;
        }
    }
    return dat;
}
