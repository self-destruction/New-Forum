function isValidData(min, max, data) {
    if (data.length >=min && data.length <= max) {
        return true;
    } else {
        return false;
    }
}