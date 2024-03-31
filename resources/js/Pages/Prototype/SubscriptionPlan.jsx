import Authenticated from "@/Layouts/Authenticated/Index";
import SubscriptionCard from "@/Components/SubscriptionCard";
export default function subscriptionPlan() {
    return (
        <Authenticated>
            <div className="py-20 flex flex-col items-center">
                <div className="text-black font-semibold text-[26px] mb-3">
                    Pricing for Everyone
                </div>
                <p className="text-base text-gray-1 leading-7 max-w-[302px] text-center">
                    Invest your little money to get a whole new experiences from
                    movies.
                </p>

                {/* <!-- Pricing Card --> */}
                <div className="flex justify-center gap-10 mt-[70px]">
                    {/* Basic */}
                    <SubscriptionCard
                        name="Basic"
                        price={299000}
                        durationInMonth={3}
                        features={[
                            "HD Available",
                            "Watch on 1 Screen",
                            "Unlimited Movies and TV Shows",
                        ]}
                    />

                    {/* <!-- For Greatest --> */}
                    <SubscriptionCard
                        isPremium
                        name={"Premium"}
                        price={599000}
                        durationInMonth={6}
                        features={[
                            "HD Available",
                            "Watch on 4 Screen",
                            "Unlimited Movies and TV Shows",
                            "Watch on Laptop, TV, Phone",
                            "Unlimited Movies and TV Shows",
                            "Cancel Anytime",
                            "No Commercials",
                            "Download and Watch Offline",
                            "Unlimited Movies and TV Shows",
                        ]}
                    />
                </div>
                {/* <!-- /Pricing Card --> */}
            </div>
        </Authenticated>
    );
}
