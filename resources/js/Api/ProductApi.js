import axios from "axios";

export async function fetchProducts(filters = {}) {
    const {
        page = null,
        brandsId = null,
        category = null,
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
        categoryId: category?.id,
        minPrice: minPrice,
        maxPrice: maxPrice,
        title: title,
    });

    return res.data;
}

export async function getProduct(slug) {
    const data = await axios.get(`/api/product/${slug}`);
    return data.data;
}

export async function getProductByIds(ids) {
    const data = await axios.post("/api/products/id", {
        productsId: ids,
    });
    return data.data;
}
