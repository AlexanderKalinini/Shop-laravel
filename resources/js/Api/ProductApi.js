import axios from "axios";

export async function fetchProducts(page = null, filters = {}) {
    const {
        brandsId = null,
        categoryId = null,
        select = "default",
        maxPrice = null,
        minPrice = null,
        title = null,
    } = filters;
    await axios.get("/sanctum/csrf-cookie");

    const res = await axios.post("/api/products", {
        page: page,
        sort: select,
        brandsId: brandsId,
        categoryId: categoryId,
        minPrice: minPrice,
        maxPrice: maxPrice,
        title: title,
    });

    return res.data;
}
