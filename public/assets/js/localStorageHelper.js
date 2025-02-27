const LOCAL_STORAGE_KEY = "orderDetails";

function setLocalStorageItems(data) {
    localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(data));
}

function getLocalStorageItems() {
    let data = localStorage.getItem(LOCAL_STORAGE_KEY);
    return data ? JSON.parse(data) : null;
}

function clearAll() {
    localStorage.removeItem(LOCAL_STORAGE_KEY);
}

export { clearAll, getLocalStorageItems, setLocalStorageItems };
