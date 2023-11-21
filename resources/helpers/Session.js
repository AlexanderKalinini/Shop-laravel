export function addObjToSession(key, obj) {
    sessionStorage.setItem(key, JSON.stringify(obj));
}

export function getObjFromSession(key) {
    return JSON.parse(sessionStorage.getItem(key));
}

export function sessionStorageEvent(key) {
    window.dispatchEvent(
        new StorageEvent("storage", {
            key: key,
        })
    );
}
