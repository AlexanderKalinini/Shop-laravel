import { addObjToSession, getObjFromSession } from "./Session";

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
        } else {
            if (this._favorits.includes(product)) return;
            this._favorits.push(product);
            // this._favorits = [...new Set(this._favorits)];
            addObjToSession("favorits", this._favorits);
        }
    }

    getFavoritById(id) {
        return this._favorits?.find((el) => el.id === id);
    }

    deleteFavoritById(id) {
        this._favorits = this._favorits.filter((el) => {
            return el.id !== id;
        });
        addObjToSession("favorits", this._favorits);
    }

    total() {
        return this._favorits?.length || null;
    }
}
