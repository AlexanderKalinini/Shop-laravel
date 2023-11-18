import { getObjFromSession, addObjToSession } from "./Session";

export function sessionEventDispatchCart() {
    window.dispatchEvent(
        new StorageEvent("storage", {
            key: "cart",
        })
    );
}

export function getCart() {
    return getObjFromSession("cart");
}

export function clearCart() {
    sessionStorage.removeItem("cart");
}

export function deleteItemFromCart(id, options) {
    let cart = getCart();
    cart = cart.filter((el) => {
        return !isEqualObjects(el.options, options) || el.id !== id;
    });

    addObjToSession("cart", cart);
}

export function isEqualObjects(obj1, obj2) {
    return JSON.stringify(obj1) === JSON.stringify(obj2);
}

export function total() {
    if (!this.cart) {
        return 0;
    }
    return this?.cart?.reduce((acc, prod) => {
        return acc + prod.count * prod.price;
    }, 0);
}

export function addProductToCart(
    product,
    count = 1,
    options = {},
    input = false
) {
    if (!count) return;
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
        count: Number(count),
        options: { ...defaultOptions, ...options },
    };

    const cart = getCart();

    if (!cart) {
        addObjToSession("cart", [mappedProd]);
    } else {
        for (let index = 0; index < cart.length; index++) {
            if (
                cart[index].id === mappedProd.id &&
                isEqualObjects(cart[index].options, mappedProd.options)
            ) {
                if (input) {
                    (cart[index].count = mappedProd.count) < 1
                        ? (cart[index].count = 1)
                        : cart[index].index;
                } else {
                    (cart[index].count += mappedProd.count) < 1
                        ? (cart[index].count = 1)
                        : cart[index].index;
                }

                addObjToSession("cart", cart);
                return;
            }
        }

        cart.push(mappedProd);

        addObjToSession("cart", cart);
        sessionEventDispatchCart();
    }
}
