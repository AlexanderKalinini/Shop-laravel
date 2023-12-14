import axios from "axios";

export async function getPromoByTitle(title) {
    if (!title) return;
    const res = await axios.get("/api/promo/" + title);
    return res.data;
}

export async function getOrders() {
    const res = await axios.get("/api/order");
    return res.data;
}

export async function deleteItemById(id) {
    const res = await axios.delete("/api/order/" + id);
    return res;
}

export async function getOrderById(id) {
    const res = await axios.get("/api/order/" + id);
    return res.data;
}

export async function postOrder(order) {
    const res = await axios.post("/api/order", {
        name: order.name,
        surname: order.surname,
        phone_number: order.phoneNumber,
        email: order.email,
        delivery_method: order.deliveryMethod,
        country: order.country,
        city: order.city,
        street: order.street,
        payment_method: order.paymentMethod,
        promo: order?.promo?.id,
        total_price: order?.totalPrice,
        status: order?.status,
        cart: order.cart,
    });

    return res;
}
