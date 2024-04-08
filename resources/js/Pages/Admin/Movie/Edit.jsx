import Authenticated from "@/Layouts/Authenticated/Index";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import Input from "@/Components/TextInput";
import Label from "@/Components/InputLabel";
import Button from "@/Components/PrimaryButton";
import { Head, Link, useForm } from "@inertiajs/react";
import Checkbox from "@/Components/Checkbox";
import { data } from "flickity";
import { Inertia } from "@inertiajs/inertia";

export default function Edit({ auth, movie }) {
    const { data, setData, processing, errors } = useForm({
        ...movie,
    });

    const onHandleChange = (event) => {
        setData(
            event.target.name,
            event.target.type === "file"
                ? event.target.files[0]
                : event.target.value
        );
    };

    const submit = (e) => {
        e.preventDefault();

        if (data.thumbnail === movie.thumbnail) {
            delete data.thumbnail;
        }

        Inertia.post(route("admin.dashboard.movie.update", movie.id), {
            _method: "PUT",
            ...data,
        });
    };
    return (
        <>
            <Authenticated auth={auth}>
                <Head title="Update Movie" />
                <h1 className="text-xl">Update Movie: {movie.name}</h1>
                <hr className="mb-4" />
                <form onSubmit={submit}>
                    <Label forinput="name" value="Name" />
                    <Input
                        id="name"
                        type="text"
                        name="name"
                        defaultValue={movie.name}
                        variant="primary-outline"
                        placeholder="Enter the name of the movie"
                        isError={errors.name}
                        onChange={onHandleChange}
                        className="mb-4"
                    />
                    <InputError message={errors.name} />
                    <Label forinput="category" value="Category" />
                    <Input
                        id="category"
                        type="text"
                        name="category"
                        defaultValue={movie.category}
                        variant="primary-outline"
                        placeholder="Enter the category of the movie"
                        isError={errors.category}
                        onChange={onHandleChange}
                        className="mb-4"
                    />
                    <InputError message={errors.category} />
                    <Label forinput="video_url" value="Video URL" />
                    <Input
                        id="video_url"
                        type="url"
                        name="video_url"
                        defaultValue={movie.video_url}
                        variant="primary-outline"
                        placeholder="Enter the Video URL of the movie"
                        isError={errors.video_url}
                        onChange={onHandleChange}
                        className="mb-4"
                    />
                    <InputError message={errors.video_url} />
                    <Label forinput="thumbnail" value="Thumbnail" />
                    <img src={movie.thumbnail} alt="" className="w-40" />
                    <Input
                        id="thumbnail"
                        type="file"
                        name="thumbnail"
                        // defaultValue={movie.thumbnail}
                        variant="primary-outline"
                        placeholder="insert Thumbnail of the movie"
                        isError={errors.thumbnail}
                        onChange={onHandleChange}
                        className="mb-4"
                    />
                    <InputError message={errors.thumbnail} />
                    <Label forinput="rating" value="Rating" />
                    <Input
                        id="rating"
                        type="number"
                        name="rating"
                        defaultValue={movie.rating}
                        variant="primary-outline"
                        placeholder="Enter the Rating of the movie"
                        isError={errors.rating}
                        onChange={onHandleChange}
                        className="mb-4"
                    />
                    <InputError message={errors.rating} />
                    <div className="flex flex-row mt-4 items-center">
                        <Label
                            forinput="is_featured"
                            value="Is Featured"
                            className="mr-3 mt-1"
                        />
                        <Checkbox
                            name="is_featured"
                            id="is_featured"
                            onChange={(e) =>
                                setData("is_featured", e.target.checked)
                            }
                            checked={data.is_featured}
                        />
                    </div>
                    <Button
                        type="submit"
                        className="mt-4"
                        variant={"primary"}
                        processing={processing}
                    >
                        Save
                    </Button>
                </form>
            </Authenticated>
        </>
    );
}
