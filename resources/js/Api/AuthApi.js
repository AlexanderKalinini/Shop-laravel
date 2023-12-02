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

export async function editProfile(data) {
    const res = await axios.post(
        "api/edit-profile",
        {
            name: data?.name,
            email: data?.email,
            password: data?.password,
            password_confirmation: data?.password_confirmation,
            _method: "patch",
        },

        {
            headers: {
                "Content-Type": "multipart/form-data",
                Accept: "application/json",
            },
        }
    );
    return res.data;
}
