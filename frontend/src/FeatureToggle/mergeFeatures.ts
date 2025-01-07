const transform = (features: { [featureName: string]: boolean } | string[]) => {
  if (!Array.isArray(features)) {
    return features;
  }
  return Object.fromEntries(
    features.map((value) => {
      if (value.startsWith('!')) {
        return [value.substring(1), false];
      }
      return [value, true];
    })
  );
};

const mergeFeatures = (...lists: ({ [featureName: string]: boolean } | string[])[]) => {
  const features = lists.map(transform).reduce((previous, current) => ({ ...previous, ...current }));
  return Object.entries(features)
    .filter(([, value]) => value)
    .map(([name]) => name)
    .sort();
};

export default mergeFeatures;
