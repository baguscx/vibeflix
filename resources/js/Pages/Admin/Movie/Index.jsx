import { Link, Head, useForm } from "@inertiajs/react";
import Authenticated from "@/Layouts/Authenticated/Index";
import Button from "@/Components/PrimaryButton";
import FlashMessage from "@/Components/FlashMessage";

export default function Index({ auth, flashMessage, movies }) {
    const { delete: destroy, put } = useForm();
    return (
        <>
            <Head title="List of Movie" />
            <Authenticated auth={auth}>
                <Link href={route("admin.dashboard.movie.create")}>
                    <Button
                        variant="primary"
                        type="button"
                        className="w-40 mb-8"
                    >
                        Insert New Movie
                    </Button>
                </Link>
                {flashMessage.message && (
                    <FlashMessage
                        message={flashMessage.message}
                        type={flashMessage.type}
                    />
                )}
                <table className="table-fixed w-full text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th colSpan={2}>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {movies.map((movie) => (
                            <tr key={movie.id}>
                                <td>
                                    <img
                                        src={`/storage/${movie.thumbnail}`}
                                        className="w-32 rounded-md"
                                        alt=""
                                    />
                                </td>
                                <td>{movie.name}</td>
                                <td>{movie.category}</td>
                                <td>{movie.rating.toFixed(1)}</td>
                                <td>
                                    <Link
                                        href={route(
                                            "admin.dashboard.movie.edit",
                                            movie.id
                                        )}
                                    >
                                        <Button
                                            type="button"
                                            variant={
                                                movie.deleted_at
                                                    ? "white-outline"
                                                    : "warning"
                                            }
                                            disabled={
                                                movie.deleted_at
                                                    ? "disabled"
                                                    : ""
                                            }
                                        >
                                            Edit
                                        </Button>
                                    </Link>
                                </td>
                                <td>
                                    <div
                                        onClick={() => {
                                            movie.deleted_at
                                                ? put(
                                                      route(
                                                          "admin.dashboard.movie.restore",
                                                          movie.id
                                                      )
                                                  )
                                                : destroy(
                                                      route(
                                                          "admin.dashboard.movie.destroy",
                                                          movie.id
                                                      )
                                                  );
                                        }}
                                    >
                                        <Button type="button" variant="danger">
                                            {movie.deleted_at
                                                ? "Restore"
                                                : "Delete"}
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </Authenticated>
        </>
    );
}
