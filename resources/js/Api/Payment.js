import axios from "axios";

export async function getPaymentLink(data) {
    const res = await axios.post("/api/payment/", {
        price: data.price,
        order_id: data.order_id,
    });
    return res;
}
