import { addObjToSession, getObjFromSession } from "./Session";
import { alert } from "./Cart";

export default class {
    static _favorits = [];

    constructor() {
        this.getFavoritsFromSession();
    }

    getFavoritsFromSession() {
        this._favorits = getObjFromSession("favorits");
    }

    getFavorits() {
        this._favorits = getObjFromSession("favorits");
        return this._favorits;
    }

    setFavorit(product) {
        if (!this._favorits) {
            this._favorits = [product];
            addObjToSession("favorits", this._favorits);
            alert(`Товар ${product.title} добавлен в избранное`);
        } else {
            if (this._favorits.includes(product)) return;
            this._favorits.push(product);
            addObjToSession("favorits", this._favorits);
            alert(`Товар ${product.title} добавлен в избранное`);
        }
    }

    getFavoritById(id) {
        return this._favorits?.find((el) => el.id === id);
    }

    deleteFavoritById(product) {
        this._favorits = this._favorits.filter((favorit) => {
            if (favorit.id === product.id) {
                alert(`Товар ${favorit.title} удален из избранного`);
            }
            return favorit.id !== product.id;
        });
        addObjToSession("favorits", this._favorits);
    }

    total() {
        return this._favorits?.length || null;
    }
}
