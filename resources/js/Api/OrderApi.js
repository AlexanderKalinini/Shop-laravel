import axios from "axios";

export async function getPromoByTitle(title) {
    console.log(title);
    if (!title) return;
    const res = await axios.get("/api/promo/" + title);
    return res.data;
}

export async function postOrder(order) {
    const res = await axios.post("/api/order", {
        name: order.name,
        surname: order.surname,
        phoneNumber: order.phoneNumber,
        email: order.email,
        deliveryMethod: order.deliveryMethod,
        city: order.city,
        street: order.street,
        paymentMethod: order.paymentMethod,
        promo: order?.promo?.id,
        cart: order.cart,
    });

    return res;
}
