import {
    getObjFromSession,
    addObjToSession,
    sessionStorageEvent,
} from "./Session";
import { useToast } from "vue-toastification";

const toast = useToast();

export function getCart() {
    return getObjFromSession("cart");
}

export function clearCart() {
    sessionStorage.removeItem("cart");
    sessionStorageEvent("cart");
}

export function deleteItemFromCart(id, options) {
    let cart = getCart();
    cart = cart.filter((el) => {
        if (isEqualObjects(el.options, options) && el.id === id) {
            alert(`Товар ${el.title} удален из корзины`);
        }
        return !isEqualObjects(el.options, options) || el.id !== id;
    });
    addObjToSession("cart", cart);
}

export function isEqualObjects(obj1, obj2) {
    return JSON.stringify(obj1) === JSON.stringify(obj2);
}

export function total(cart = []) {
    if (!Array.isArray(cart)) {
        return;
    }

    if (!cart || cart.length === 0) {
        return 0;
    }

    return cart.reduce((acc, prod) => {
        return acc + prod.quantity * prod.price;
    }, 0);
}

export function totalDiscount(cart = []) {
    if (!Array.isArray(cart)) {
        return;
    }

    if (!cart || cart.length === 0) {
        return 0;
    }

    return cart.reduce((acc, prod) => {
        return Math.round(
            acc + prod.quantity * prod.price * (prod?.promo_code?.discount ?? 0)
        );
    }, 0);
}

export function alert(message = "") {
    toast(message, {
        closeButton: false,
        timeout: 1500,
        position: "top-center",
        hideProgressBar: true,
        toastClassName: "!bg-purple",
        icon: false,
    });
}

export function addProductToCart(
    product,
    quantity = 1,
    options = {},
    input = false,
    withAlert = true
) {
    if (!quantity) return;

    const defaultOptions = Object.fromEntries(
        Object.entries(product?.options).map((el) => {
            return [el[0], el[1][0]];
        })
    );

    const mappedProd = {
        id: product?.id,
        slug: product?.slug,
        title: product?.title,
        price: product?.price,
        quantity: Number(quantity),
        options: { ...defaultOptions, ...options },
    };

    const cart = getCart();

    if (!cart) {
        addObjToSession("cart", [mappedProd]);
        withAlert && alert(`Товар ${mappedProd.title} добавлен в корзину`);
    } else {
        for (let index = 0; index < cart.length; index++) {
            if (
                cart[index].id === mappedProd.id &&
                isEqualObjects(cart[index].options, mappedProd.options)
            ) {
                if (input) {
                    (cart[index].quantity = mappedProd.quantity) < 1
                        ? (cart[index].quantity = 1)
                        : cart[index].index;
                } else {
                    (cart[index].quantity += mappedProd.quantity) < 1
                        ? (cart[index].quantity = 1)
                        : cart[index].index;
                }

                addObjToSession("cart", cart);

                withAlert &&
                    alert(`Товар ${mappedProd.title} добавлен в корзину`);

                return;
            }
        }

        cart.push(mappedProd);
        addObjToSession("cart", cart);
        withAlert && alert(`Товар ${mappedProd.title} добавлен в корзину`);
    }
}
