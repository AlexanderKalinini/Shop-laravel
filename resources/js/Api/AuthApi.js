import axios from "axios";

export async function signup(user) {
    const res = await axios.post(
        "/api/sign-up-mail",
        {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation,
        },
        {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        }
    );

    return res.data;
}
