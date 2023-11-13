import axios from "axios";

export async function loadCategoriesForHomePage() {
    try {
        const res = await axios.get("/api/category-show");
        return res.data;
    } catch (err) {
        console.log(err.message);
    }
}

export async function loadCategories() {
    try {
        const res = await axios.get("/api/filters");
        return res.data.categories;
    } catch (err) {
        console.log(err.message);
    }
}
